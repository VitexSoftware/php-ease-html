---
description: EaseHtml - PHP HTML generation library for VitexSoftware ecosystem
applyTo: '**'
---

# EaseHtml - Copilot Instructions

## Project Overview
EaseHtml is a **foundational PHP library** for HTML generation in the VitexSoftware ecosystem:
- **Object-Oriented HTML**: Create HTML elements as PHP objects
- **Type-Safe Generation**: Full PHP 8.4+ type system integration
- **Framework Foundation**: Used by all VitexSoftware web applications
- **Component Library**: Reusable HTML components and widgets
- **Standards Compliance**: W3C valid HTML output

## 📋 Development Standards

### Core Coding Guidelines
- **PHP 8.4+**: Use modern PHP features and strict types: `declare(strict_types=1);`
- **PSR-12**: Follow PHP-FIG coding standards for consistency
- **Type Safety**: Include type hints for all parameters and return types
- **Documentation**: PHPDoc blocks for all public methods and classes
- **Testing**: PHPUnit tests for all new functionality
- **Internationalization**: Use `_()` functions for translatable strings

### Code Quality Requirements
- **Syntax Validation**: After every PHP file edit, run `php -l filename.php` for syntax checking
- **HTML Validation**: Ensure generated HTML is W3C compliant
- **Error Handling**: Implement comprehensive try-catch blocks with meaningful error messages
- **Testing**: Create/update PHPUnit test files for all new/modified classes
- **Performance**: Optimize HTML generation for large documents
- **Security**: Prevent XSS attacks through proper escaping

### Development Best Practices
- **Code Comments**: Write in English using complete sentences and proper grammar
- **Variable Names**: Use meaningful names that describe their purpose
- **Constants**: Avoid magic numbers/strings; define constants instead
- **Exception Handling**: Always provide meaningful error messages
- **Commit Messages**: Use imperative mood and keep them concise
- **Security**: Ensure code is secure and doesn't expose sensitive information
- **Compatibility**: Maintain compatibility with latest PHP and library versions
- **Maintainability**: Follow best practices for maintainable code

### HTML Generation Guidelines
- **Valid Output**: All generated HTML must be W3C compliant
- **Escape User Data**: Always escape user input to prevent XSS attacks
- **Semantic HTML**: Use proper HTML5 semantic elements
- **Accessibility**: Include ARIA labels and proper accessibility features
- **Performance**: Generate efficient HTML structure
- **CSS Classes**: Use consistent CSS class naming conventions

### Testing Requirements
- **PHPUnit Integration**: All new classes require corresponding test files
- **HTML Output Tests**: Validate generated HTML structure and content
- **XSS Prevention Tests**: Test proper escaping of malicious input
- **Performance Tests**: Ensure acceptable performance with large documents

⚠️ **Important Notes for Copilot:**
- This is a **core foundation library** used throughout the VitexSoftware ecosystem
- **Backward compatibility** is critical - breaking changes affect all dependent projects
- **Security is paramount** - any XSS vulnerabilities affect all applications
- **Performance matters** - this library generates HTML for large applications
- All changes must be thoroughly tested across the entire ecosystem
