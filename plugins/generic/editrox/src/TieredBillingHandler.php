<?php

namespace APP\plugins\generic\editrox\src;

use PKP\db\DAORegistry;

class TieredBillingHandler {
    public function calculateAdjustedFee(float $baseAmount, ?int $userId): float {
        if (!$userId) return $baseAmount;

        $userDao = DAORegistry::getDAO('UserDAO');
        $user = $userDao->getById($userId);
        $country = $user ? $user->getCountry() : null;

        // Group A: Low-Income Economies (100% waiver)
        $lowIncome = ['AF', 'ET', 'MW', 'MZ', 'UG', 'YE', 'CD', 'MG', 'NE', 'SO', 'SD'];
        // Group B: Lower-Middle-Income Economies (50% reduction)
        $lowerMiddle = ['IN', 'NG', 'PK', 'BD', 'VN', 'KE', 'LK', 'PH', 'ID', 'GH'];

        if (in_array($country, $lowIncome)) {
            return 0.00;
        } elseif (in_array($country, $lowerMiddle)) {
            return round($baseAmount * 0.50, 2);
        }

        return $baseAmount;
    }
}
