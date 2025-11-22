# Changelog

All notable changes to Cordobo Green Park 2 will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-11-22

### Added
- **theme.json** - Modern WordPress theme configuration file with global settings and styles
- **Block Editor Support** - Full Gutenberg/Block Editor support including:
  - Wide and full alignment support (`align-wide`)
  - Block styles support (`wp-block-styles`)
  - Custom line height support
  - Custom spacing support
  - Custom units support
  - Link color support
  - Appearance tools support
  - Border controls support
- **HTML5 Support** - Added HTML5 theme support for:
  - Search forms
  - Comment forms
  - Comment lists
  - Galleries
  - Captions
  - Scripts and styles
  - Navigation widgets
- **Responsive Embeds** - Automatic responsive sizing for embedded content
- **Editor Styles** - Created `editor-style.css` for block editor visual consistency
- **Security Features**:
  - Nonce verification for all forms (`wp_nonce_field`)
  - Input sanitization using WordPress functions
  - Output escaping throughout all templates
  - CSRF protection on theme options
- **Modern Color Palette** - Defined in theme.json:
  - Primary Green (#4a7c59)
  - Secondary Green (#6b9279)
  - Background (#D5DADD)
  - Foreground (#333333)
  - White and Light Gray variants
- **Typography Settings** - Font size and family presets in theme.json
- **Spacing Controls** - Padding, margin, and block gap controls

### Changed
- **Version** - Bumped from 1.0.0-beta.10 to 2.0.0 (stable release)
- **WordPress Requirement** - Now requires WordPress 6.0+ (was 3.x/4.x)
- **PHP Requirement** - Now requires PHP 7.4+ (was 5.x)
- **URLs** - Updated all HTTP URLs to HTTPS throughout the theme
- **Header Template** - Removed IE conditional comments (no longer needed)
- **Security** - Complete overhaul of theme options handling:
  - Replaced `stripslashes()` with `wp_unslash()`
  - Added `sanitize_text_field()` for text inputs
  - Added `wp_kses_post()` for HTML content
  - Added `esc_url_raw()` for URLs
  - Added `wp_kses()` for script tags (Google Analytics, AdSense)
- **Accessibility Links** - Refactored using proper escaping:
  - Replaced `_e()` with `esc_html_e()` and `esc_attr_e()`
  - Improved code structure with proper if/endif blocks
  - Better URL escaping with `esc_url()`
- **Theme Options Display** - Enhanced security in admin forms:
  - Added proper escaping with `esc_attr()`, `esc_textarea()`
  - Used `checked()` helper function for checkboxes
  - Added nonce field to form
- **Footer Template** - Secured Google Analytics output with `wp_kses()`
- **Schema.org URLs** - Updated from HTTP to HTTPS
- **XFN Profile URL** - Updated to HTTPS
- **Error Messages** - Use `esc_html__()` instead of `_e()` in `wp_die()`

### Removed
- **Deprecated Functions**:
  - `wp_meta()` - Deprecated since WordPress 3.0
  - `wp_register()` - Deprecated since WordPress 3.5
- **IE Conditional Comments** - No longer needed for modern browsers
- **X-UA-Compatible Meta Tag** - Not needed for modern browsers
- **Flush Comment** - Removed commented-out flush() call in header

### Fixed
- **XSS Vulnerabilities** - Fixed all cross-site scripting vulnerabilities:
  - Google Analytics code injection
  - Theme options form inputs
  - All template outputs
- **CSRF Vulnerabilities** - Added nonce verification to prevent cross-site request forgery
- **SQL Injection** - Proper use of WordPress options API prevents SQL injection
- **Direct POST Access** - All `$_POST` access now properly sanitized
- **Unsafe Echo Statements** - Replaced direct echo with escaped output functions

### Security
- **CRITICAL**: Fixed multiple XSS vulnerabilities in theme options
- **CRITICAL**: Added CSRF protection to all forms
- **HIGH**: Sanitized all user inputs in theme options
- **HIGH**: Escaped all outputs in templates and admin pages
- **MEDIUM**: Validated and sanitized Google Analytics and AdSense codes

### Deprecated
- **Note**: This theme no longer supports WordPress versions below 6.0
- **Note**: This theme no longer supports PHP versions below 7.4
- **Note**: Internet Explorer is no longer supported

### Migration Notes
When upgrading from 1.0.0-beta.x to 2.0.0:
1. Ensure WordPress is version 6.0 or higher
2. Ensure PHP is version 7.4 or higher
3. Review theme settings in admin panel after upgrade
4. Test all custom configurations
5. Clear all caches (WordPress, browser, CDN)
6. Test with the Block Editor if you plan to use it

## [1.0.0-beta.10] - Previous Beta Release

Previous beta release before modernization. See git history for details.

---

## Legend

- **Added** - New features
- **Changed** - Changes in existing functionality
- **Deprecated** - Soon-to-be removed features
- **Removed** - Removed features
- **Fixed** - Bug fixes
- **Security** - Security improvements
