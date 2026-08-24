<?php

namespace App\Support;

/**
 * Minimal, dependency-free PDF writer that renders a clean one-column CV
 * from the portfolio's content arrays.
 *
 * Produces a valid PDF 1.4 document using only core Type1 fonts
 * (Helvetica family, WinAnsi encoding) so nothing has to be embedded.
 */
class CvPdf
{
    private const PAGE_W = 595.28;  // A4 portrait, points
    private const PAGE_H = 841.89;
    private const MARGIN = 56;
    private const CONTENT_W = self::PAGE_W - 2 * self::MARGIN;

    /** Accent color (indigo-ish) used for rules and headings, RGB 0-1. */
    private const ACCENT = [0.31, 0.27, 0.90];
    private const GRAY = [0.42, 0.42, 0.45];

    /** @var string[] Finished content streams, one per page */
    private array $pages = [];

    /** Ops of the page currently being composed. */
    private string $ops = '';

    private float $y = 0;

    /**
     * Build the PDF document.
     *
     * @param array $data profile/stats/education/projects/generated arrays
     */
    public function generate(array $data): string
    {
        $this->y = self::PAGE_H - self::MARGIN;

        $p = $data['profile'];

        /* ---------------- Header ---------------- */
        $this->text(self::MARGIN, $this->y, 26, 'F2', $p['name']);
        $this->y -= 26;

        $this->coloredText(self::ACCENT, self::MARGIN, $this->y, 12.5, 'F2', strtoupper($p['role']));
        $this->y -= 18;

        $contact = array_filter([
            $p['email'],
            $p['phone'] ?? null,
            $p['location'],
            preg_replace('#^https?://(www\.)?#', '', $p['github']),
            preg_replace('#^https?://(www\.)?#', '', $p['linkedin']),
        ]);
        foreach ($this->wrap(implode('   ·   ', $contact), 9.5, 'F1') as $line) {
            $this->grayText(self::MARGIN, $this->y, 9.5, 'F1', $line);
            $this->y -= 13;
        }

        $this->y -= 6;
        $this->rule();

        /* ---------------- Sections ---------------- */
        $this->section('Profile');
        foreach ($p['bio'] as $paragraph) {
            foreach ($this->wrap($paragraph, 10.5, 'F1') as $line) {
                $this->ensureSpace();
                $this->text(self::MARGIN, $this->y, 10.5, 'F1', $line);
                $this->y -= 15;
            }
            $this->y -= 4;
        }
        $this->y -= 6;

        $this->section('Education & Certifications');
        foreach ($data['education'] as $entry) {
            $meta = trim(sprintf('%s · %s · %s', $entry['institution'], $entry['field'], $entry['period']), ' ·');

            $this->ensureSpace(46);
            $this->text(self::MARGIN, $this->y, 11, 'F2', $entry['degree']);
            $this->y -= 13.5;
            $this->grayText(self::MARGIN, $this->y, 9.5, 'F3', $meta);
            $this->y -= 13;

            if (!empty($entry['description'])) {
                foreach ($this->wrap($entry['description'], 10, 'F1') as $line) {
                    $this->ensureSpace();
                    $this->text(self::MARGIN + 10, $this->y, 10, 'F1', $line);
                    $this->y -= 14;
                }
            }
            $this->y -= 8;
        }
        $this->y -= 4;

        $this->section('Selected Projects');
        foreach (array_slice($data['projects'], 0, 6) as $project) {
            $this->ensureSpace(40);
            $this->text(self::MARGIN, $this->y, 11, 'F2', $project['title']);
            $this->y -= 13;
            $this->grayText(self::MARGIN, $this->y, 9.5, 'F3', implode(', ', $project['tags']));
            $this->y -= 12.5;

            foreach ($this->wrap($project['description'], 10, 'F1') as $line) {
                $this->ensureSpace();
                $this->text(self::MARGIN + 10, $this->y, 10, 'F1', $line);
                $this->y -= 14;
            }
            $this->y -= 6;
        }

        /* ---------------- Footer on last page ---------------- */
        if ($this->y < self::MARGIN + 30) {
            $this->newPage();
        }
        $footer = 'Generated '.$data['generated'].'  ·  '.preg_replace('#^https?://(www\.)?#', '', url('/'));
        $this->rule(0.35);
        $this->grayText(self::MARGIN, max(self::MARGIN, $this->y - 14), 8.5, 'F3', $footer);

        $this->pages[] = $this->ops;

        return $this->assemble();
    }

    /* ==================== Layout helpers ==================== */

    private function section(string $title): void
    {
        $this->ensureSpace(48);
        $this->y -= 6;
        $this->coloredText(self::ACCENT, self::MARGIN, $this->y, 11.5, 'F2', strtoupper($title));
        $this->y -= 7;
        $this->rule(0.6);
        $this->y -= 16;
    }

    private function rule(float $width = 1.2): void
    {
        $this->ops .= sprintf(
            "%s w %s RG %.2F %.2F m %.2F %.2F l S\n",
            number_format($width, 2, '.', ''),
            $this->colorStroke(self::ACCENT),
            self::MARGIN,
            $this->y,
            self::PAGE_W - self::MARGIN,
            $this->y
        );
        $this->y -= 12;
    }

    private function ensureSpace(float $needed = 18): void
    {
        if ($this->y - $needed < self::MARGIN) {
            $this->newPage();
        }
    }

    private function newPage(): void
    {
        $this->pages[] = $this->ops;
        $this->ops = '';
        $this->y = self::PAGE_H - self::MARGIN;
    }

    private function text(float $x, float $y, float $size, string $font, string $str): void
    {
        $this->ops .= sprintf(
            "BT /%s %.1F Tf %s rg %.2F %.2F Td (%s) Tj ET\n",
            $font,
            $size,
            $this->colorFill([0, 0, 0]),
            $x,
            $y,
            $this->escape($str)
        );
    }

    private function grayText(float $x, float $y, float $size, string $font, string $str): void
    {
        $this->ops .= sprintf(
            "BT /%s %.1F Tf %s rg %.2F %.2F Td (%s) Tj ET\n",
            $font,
            $size,
            $this->colorFill(self::GRAY),
            $x,
            $y,
            $this->escape($str)
        );
    }

    private function coloredText(array $rgb, float $x, float $y, float $size, string $font, string $str): void
    {
        $this->ops .= sprintf(
            "BT /%s %.1F Tf %s rg %.2F %.2F Td (%s) Tj ET\n",
            $font,
            $size,
            $this->colorFill($rgb),
            $x,
            $y,
            $this->escape($str)
        );
    }

    private function colorFill(array $c): string
    {
        return sprintf('%.3F %.3F %.3F', $c[0], $c[1], $c[2]);
    }

    private function colorStroke(array $c): string
    {
        return sprintf('%.3F %.3F %.3F', $c[0], $c[1], $c[2]);
    }

    /**
     * Approximate word-wrap for Helvetica (~0.52 em average glyph width).
     *
     * @return string[]
     */
    private function wrap(string $text, float $size, string $font): array
    {
        $factor = $font === 'F2' ? 0.56 : 0.52;
        $maxChars = (int) floor(self::CONTENT_W / ($size * $factor));

        $lines = [];
        foreach (preg_split('/\R/u', $text) ?: [$text] as $paragraph) {
            $line = '';
            foreach (explode(' ', $paragraph) as $word) {
                $candidate = $line === '' ? $word : $line.' '.$word;
                if (mb_strlen($candidate) > $maxChars && $line !== '') {
                    $lines[] = $line;
                    $line = $word;
                } else {
                    $line = $candidate;
                }
            }
            if ($line !== '') {
                $lines[] = $line;
            }
        }

        return $lines ?: [''];
    }

    /**
     * Convert UTF-8 to WinAnsi and escape for a PDF literal string.
     */
    private function escape(string $str): string
    {
        $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', str_replace("\r", '', $str));
        if ($converted === false) {
            $map = ["\u{2018}" => "'", "\u{2019}" => "'", "\u{201C}" => '"', "\u{201D}" => '"',
                "\u{2013}" => '-', "\u{2014}" => '-', "\u{2026}" => '...', "\u{00A0}" => ' '];
            $converted = strtr($str, $map);
        }

        $out = '';
        foreach (str_split($converted) as $char) {
            $ord = ord($char);
            $out .= match (true) {
                $char === '\\' || $char === '(' || $char === ')' => '\\'.$char,
                $ord >= 128 => sprintf('\\%03o', $ord),
                default => $char,
            };
        }

        return $out;
    }

    /* ==================== Document assembly ==================== */

    private function assemble(): string
    {
        $objects = [];

        // 1: catalog, 2: pages, 3-5: fonts — filled after pages are known.
        $pageObjectIds = [];
        $pageCount = count($this->pages);
        for ($i = 0; $i < $pageCount; $i++) {
            $pageObjectIds[] = 6 + $i * 2;
        }

        $kids = implode(' ', array_map(fn ($id) => "$id 0 R", $pageObjectIds));

        $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[2] = "<< /Type /Pages /Kids [$kids] /Count $pageCount >>";
        $objects[3] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>";
        $objects[4] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>";
        $objects[5] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Oblique /Encoding /WinAnsiEncoding >>";

        foreach ($this->pages as $index => $stream) {
            $pageId = 6 + $index * 2;
            $contentId = $pageId + 1;

            $objects[$pageId] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 ".self::PAGE_W.' '.self::PAGE_H."] "
                ."/Resources << /Font << /F1 3 0 R /F2 4 0 R /F3 5 0 R >> >> /Contents $contentId 0 R >>";
            $objects[$contentId] = "<< /Length ".strlen($stream)." >>\nstream\n$stream\nendstream";
        }

        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [];
        foreach ($objects as $id => $body) {
            $offsets[$id] = strlen($pdf);
            $pdf .= "$id 0 obj\n$body\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $size = count($objects) + 1;
        $pdf .= "xref\n0 $size\n0000000000 65535 f \n";
        foreach ($offsets as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }
        $pdf .= "trailer\n<< /Size $size /Root 1 0 R >>\nstartxref\n$xrefOffset\n%%EOF";

        return $pdf;
    }
}
