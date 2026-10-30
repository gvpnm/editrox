<?php

namespace APP\plugins\generic\editrox\src;

class AnalyticsAggregator {
    public function renderMetricsCard(string $doi): string {
        $cleanDoi = urlencode($doi);
        $url = "https://api.openalex.org/works/https://doi.org/" . $cleanDoi;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Editrox-OJS/1.0 (mailto:admin@editrox.org)');
        $response = curl_exec($ch);
        curl_close($ch);

        $citations = 0;
        if ($response) {
            $data = json_decode($response, true);
            $citations = $data['cited_by_count'] ?? 0;
        }

        return '<div class="editrox-impact-card" style="margin: 1.5rem 0; padding: 1rem; background: #f8fafc; border-radius: 8px; border: 1px solid #cbd5e1; border-left: 4px solid #2563eb;">'
             . '<h4 style="margin:0 0 0.5rem 0; font-size: 1rem; color: #0f172a;">Article Impact & Readership</h4>'
             . '<p style="margin:0; font-size: 0.9rem; color: #334155;">Citations: <strong style="color: #0f172a;">' . (int)$citations . '</strong> (Indexed via OpenAlex)</p>'
             . '</div>';
    }
}
