# Distribution Algorithm Specification

This is the distribution algorithm for the spec detailed in @.agent-os/specs/animated-logo-carousel.md

> Created: 2025-01-10
> Version: 1.0.0

## Algorithm Overview

The logo distribution algorithm ensures that Automattic, WooCommerce, and WordPress VIP logos never appear in the same column while maintaining visual balance and brand hierarchy across all 4 carousel columns.

## Core Constraints

### Primary Constraint: WordPress Family Separation
```php
$wordpressFamily = [
    'WooCommerce',
    'Automattic', 
    'WordPress VIP'
];
```
These three logos must be distributed across different columns (maximum 1 per column, with 1 column having none).

### Secondary Constraints
- **Balanced Distribution**: Each column should have 5-6 logos (22 total ÷ 4 columns)
- **Visual Weight Balance**: Distribute colorful and prominent logos evenly
- **Brand Hierarchy**: Maintain appropriate visual prominence for key clients

## Algorithm Implementation

### Step 1: WordPress Family Pre-Assignment
```php
public function distribute(array $allLogos): array 
{
    $columns = [[], [], [], []];
    $wordpressFamily = $this->getWordpressFamily($allLogos);
    $remainingLogos = $this->removeWordpressFamily($allLogos);
    
    // Assign WordPress family to first 3 columns (leave column 4 empty)
    foreach ($wordpressFamily as $index => $logo) {
        $columns[$index][] = $logo;
    }
    
    return $this->distributeRemaining($remainingLogos, $columns);
}
```

### Step 2: Remaining Logo Distribution
```php
private function distributeRemaining(array $logos, array $columns): array 
{
    // Target: 5-6 logos per column
    $targetPerColumn = ceil(count($logos) / 4);
    
    // Shuffle for randomization while maintaining constraints
    $shuffledLogos = $this->shuffle($logos);
    
    foreach ($shuffledLogos as $logo) {
        $targetColumn = $this->findBestColumn($logo, $columns, $targetPerColumn);
        $columns[$targetColumn][] = $logo;
    }
    
    return $this->balanceColumns($columns);
}
```

### Step 3: Visual Weight Balancing
```php
private function findBestColumn(array $logo, array $columns, int $target): int 
{
    $scores = [];
    
    foreach ($columns as $index => $column) {
        $scores[$index] = $this->calculateColumnScore($logo, $column, $target);
    }
    
    // Return column index with highest score (best fit)
    return array_keys($scores, max($scores))[0];
}

private function calculateColumnScore(array $logo, array $column, int $target): float 
{
    $score = 0;
    
    // Prefer columns closer to target size
    $sizeDifference = abs(count($column) - $target);
    $score += (10 - $sizeDifference); // Higher score for closer to target
    
    // Balance visual weight (colorful vs standard logos)
    $colorfulCount = $this->countColorfulLogos($column);
    if ($logo['class'] === 'colorful') {
        $score += (3 - $colorfulCount); // Prefer columns with fewer colorful logos
    }
    
    // Prevent columns from becoming too large
    if (count($column) >= $target + 1) {
        $score -= 5;
    }
    
    return $score;
}
```

## Distribution Matrix Example

### Target Distribution (22 logos across 4 columns):
```
Column 1: 6 logos (including WooCommerce)
Column 2: 6 logos (including Automattic)  
Column 3: 5 logos (including WordPress VIP)
Column 4: 5 logos (no WordPress family)
```

### Sample Distribution Result:
```php
[
    // Column 1 (6 logos)
    ['WooCommerce', 'Pantheon', 'Metorik', 'DVLOP', 'BC SPCA', 'Teelaunch'],
    
    // Column 2 (6 logos)  
    ['Automattic', "Sotheby's", 'SmarterQueue', 'FedEx', 'Modern Tribe', 'Trusted Advisors'],
    
    // Column 3 (5 logos)
    ['WordPress VIP', 'Image Salon', 'TELUS Health', 'TechCrunch', 'Infrarouge'],
    
    // Column 4 (5 logos)
    ['PHAiTO', 'Turquoise Goat', 'FSquared Marketing', 'Spark Consulting', 'The Events Calendar']
]
```

## Visual Weight Classification

### Logo Categories for Balanced Distribution:
```php
private function getLogoCategory(array $logo): string 
{
    switch ($logo['class']) {
        case 'colorful':
            return 'high-visual-weight';  // DVLOP, TELUS Health, FedEx, etc.
        case 'always-invert':
        case 'invert-light':
            return 'medium-visual-weight'; // Sotheby's, Automattic, Modern Tribe
        case 'image-salon':
        case 'turquoise-goat':
            return 'special-handling';     // Unique visual treatment
        default:
            return 'standard-weight';      // Most logos
    }
}
```

## Algorithm Testing & Validation

### Constraint Validation Tests
```php
public function validateDistribution(array $distributedColumns): bool 
{
    // Test 1: WordPress family constraint
    $wordpressPositions = [];
    foreach ($distributedColumns as $columnIndex => $column) {
        foreach ($column as $logo) {
            if (in_array($logo['name'], $this->wordpressFamily)) {
                $wordpressPositions[] = $columnIndex;
            }
        }
    }
    
    // Must have exactly 3 WordPress family logos in different columns
    if (count($wordpressPositions) !== 3 || count(array_unique($wordpressPositions)) !== 3) {
        return false;
    }
    
    // Test 2: Balanced distribution (5-6 logos per column)
    foreach ($distributedColumns as $column) {
        if (count($column) < 5 || count($column) > 6) {
            return false;
        }
    }
    
    return true;
}
```

### Randomization with Constraints
- Algorithm includes controlled randomization to vary logo order
- Constraints always take precedence over randomization
- Results are deterministic for same input set
- Supports easy re-shuffling for different arrangements

## Edge Cases & Error Handling

### Insufficient Logos Scenario
```php
if (count($allLogos) < 4) {
    // Fallback to simple round-robin distribution
    return $this->simpleDistribution($allLogos);
}
```

### Missing WordPress Family Logos
```php
if (count($wordpressFamily) < 3) {
    // Log warning and proceed with available logos
    Log::warning('Missing WordPress family logos in distribution');
    return $this->distributeWithoutConstraints($allLogos);
}
```

### Uneven Distribution Results
- Algorithm automatically balances columns within ±1 logo
- Prioritizes constraint satisfaction over perfect balance
- Includes fallback to simple distribution if balancing fails