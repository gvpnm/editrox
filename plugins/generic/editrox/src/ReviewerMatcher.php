<?php

namespace APP\plugins\generic\editrox\src;

class ReviewerMatcher {
    public function findCandidates($submission) {
        $title = urlencode($submission->getLocalizedTitle());
        $url = "https://api.openalex.org/works?search=" . $title . "&per-page=3";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Editrox-OJS/1.0 (mailto:admin@editrox.org)');
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $html = '<ul class="editrox-candidates" style="list-style: none; padding-left: 0;">';
        if (!empty($data['results'])) {
            foreach ($data['results'] as $work) {
                foreach ($work['authorships'] as $authorship) {
                    $name = htmlspecialchars($authorship['author']['display_name']);
                    $institution = htmlspecialchars($authorship['institutions'][0]['display_name'] ?? 'Independent Researcher');
                    $html .= "<li style=\"margin-bottom: 6px; padding: 6px; background: #f1f5f9; border-radius: 4px;\"><strong>{$name}</strong> — {$institution}</li>";
                    break;
                }
            }
        } else {
            $html .= '<li>No external semantic candidates found.</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}
