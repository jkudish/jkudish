# Logo Processing and Display Update Spec

## Overview

Process and optimize all client company logos for web display with transparent backgrounds and modern formats, then update the home page to display all logos for review.

## Current State

The `/public/img/companies/` folder contains 22 company logos in mixed formats:
- PNG files: 17 (most already optimized)
- JPEG files: 3 (need background removal and conversion)
- WebP files: 1 (already optimized)

Current implementation randomly displays 8 logos from a hardcoded list of 12 companies.

## Goals

1. **Image Processing (One-time)**
   - Remove backgrounds from non-transparent images
   - Convert all images to PNG format
   - Create WebP versions of all PNGs
   - Optimize file sizes while maintaining quality
   - Clean up original JPEG files

2. **Display Update**
   - Add all 22 company logos to the home page component
   - Temporarily display all logos (remove random selection)
   - Maintain proper styling and responsiveness

## Technical Requirements

### Image Processing

#### Background Removal
- Required for: `FSquared Marketing Images.jpeg`, `bcspca.jpg`, `trusted-advisors.jpeg`
- Tool options: ImageMagick, Python PIL/Pillow, or manual processing
- Note: Automated background removal may not produce perfect results

#### Format Conversion
- Convert JPEGs to PNG with transparency
- Generate WebP versions for all PNGs
- Maintain aspect ratios and quality

#### Optimization
- Target file sizes: < 50KB for logos
- Use lossless compression for PNGs
- Use quality 85-90 for WebP conversion

### Component Updates

#### File Structure
```
public/img/companies/
├── [company-name].png (transparent PNG)
└── [company-name].webp (optimized WebP)
```

#### Blade Component Updates
- Update `$allCompanies` array to include all 22 companies
- Add new companies with appropriate CSS classes for styling
- Remove shuffle and array_slice logic temporarily
- Adjust grid layout to accommodate all logos

## Implementation Approach

### Phase 1: Image Processing

1. **Identify Processing Needs**
   - List images requiring background removal
   - Identify format conversions needed

2. **Process Images**
   - Use ImageMagick or Python for automated processing
   - Manual fallback for complex backgrounds
   - Generate WebP versions
   - Optimize all images

3. **Clean Up**
   - Delete original JPEG files
   - Ensure consistent naming

### Phase 2: Component Update

1. **Add New Companies**
   - Add missing companies to `$allCompanies` array
   - Assign appropriate CSS classes based on logo characteristics

2. **Update Display Logic**
   - Comment out shuffle/slice logic
   - Display all companies
   - Adjust grid responsive breakpoints if needed

3. **Test Display**
   - Verify all logos display correctly
   - Check dark/light mode compatibility
   - Ensure proper alignment and sizing

## CSS Classes Guide

- `standard`: Works well with default filters
- `invert-light`: Dark logos needing inversion in light mode
- `always-invert`: Very dark logos always needing inversion
- `colorful`: Colorful logos needing special grayscale handling
- `[company-name]`: Custom classes for special cases

## Success Criteria

- [ ] All logos have transparent backgrounds
- [ ] All logos available in PNG and WebP formats
- [ ] File sizes optimized (< 50KB target)
- [ ] All 22 logos display on home page
- [ ] Logos properly styled for dark/light modes
- [ ] No broken images or layout issues
- [ ] Clean folder structure (no JPEGs remaining)

## Notes

- Background removal quality may vary for complex images
- Manual intervention may be needed for some logos
- Future enhancement: Implement dynamic loading strategy for final production