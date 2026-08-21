# AI Agent Instructions & Skills Guide for PASIH

This repository is configured with **Laravel AI Agent Skills** from [laravel/agent-skills](https://github.com/laravel/agent-skills) and [skills.laravel.cloud](https://skills.laravel.cloud/).

---

## 🛠️ Project Profile & Stack

- **Framework**: Laravel 12.x (`laravel/framework: ^12.0`)
- **PHP Version**: PHP 8.2+ (Targeting strict typing and modern PHP 8.2/8.3 patterns)
- **Frontend Stack**: Vite (`vite: ^7.0`), TailwindCSS v4 (`@tailwindcss/vite`, `tailwindcss: ^4.2`), Blade Templates
- **Testing Framework**: Pest PHP 3.x (`pestphp/pest: ^3.8`, `pestphp/pest-plugin-laravel: ^3.2`), PHPUnit
- **Code Styling**: Laravel Pint (`laravel/pint: ^1.24`)
- **Document Generation**: Laravel DomPDF (`barryvdh/laravel-dompdf: ^3.1`)
- **Logging & Debugging**: Laravel Pail (`laravel/pail: ^1.2.2`)

---

## 📦 Installed AI Agent Skills

All agent skills are installed locally in `.agents/skills/` adhering to the Agent Skills Standard:

| Skill | Directory | Purpose / Triggers |
|---|---|---|
| **laravel-patterns** | `.agents/skills/laravel-patterns/` | Architecture patterns: controllers, Eloquent ORM, service layers, queues, events, caching, and API resources. |
| **laravel-security** | `.agents/skills/laravel-security/` | Security best practices: authentication, authorization policies/gates, Eloquent SQLi protection, mass assignment safety, CSRF, XSS prevention, and NIST/OWASP compliance. |
| **laravel-simplifier** | `.agents/skills/laravel-simplifier/` | Code simplification: PSR-12 conformance, eliminating boilerplate, cleaning up unnecessary nesting and ternaries while strictly preserving behavior. |
| **laravel-verification** | `.agents/skills/laravel-verification/` | Quality assurance loop: syntax linting, static analysis, Pest/PHPUnit tests, code coverage, and deployment readiness checks. |
| **laravel-tdd** | `.agents/skills/laravel-tdd/` | Test-Driven Development: writing robust Pest/PHPUnit tests, factories, HTTP feature tests, auth mocking, and test assertions. |
| **php-best-practices** | `.agents/skills/php-best-practices/` | Modern PHP 8.2+ practices: strict types, return types, match expressions, DTOs, SOLID principles, and PSR compliance. |
| **laravel-specialist** | `.agents/skills/laravel-specialist/` | Deep Laravel feature implementation: Eloquent relationships, Sanctum auth, Horizon queues, REST APIs, and reactive interfaces. |
| **deploying-laravel-cloud** | `.agents/skills/deploying-laravel-cloud/` | Laravel Cloud deployment, environment configuration, database/cache setup, domains, and cloud CLI commands. |
| **configure-nightwatch** | `.agents/skills/configure-nightwatch/` | Nightwatch monitoring, telemetry configuration, sampling rates, and PII redaction. |
| **starter-kit-upgrade** | `.agents/skills/starter-kit-upgrade/` | Upstream synchronization and upgrade workflows with official starter kits. |

---

## 🎯 Developer & Agent Workflows

### 1. Code Writing & Architecture
When generating or refactoring controllers, services, or models:
- Always declare strict types and explicit return types (`php-best-practices`).
- Use dedicated Form Request classes for validation instead of inline validation in controllers (`laravel-patterns`).
- Keep controllers thin and extract complex business logic into action/service classes or Eloquent query scopes (`laravel-patterns`).
- Run `laravel-simplifier` review after completing changes.

### 2. Security Guidelines
- Enforce NIST SP 800-63B Rev. 4 & OWASP Top 10 guidelines (`laravel-security`).
- Password validation uses `Password::min(15)->uncompromised()`.
- Use generic authentication failure error messages (`"Email atau password salah."`).
- Always authorize actions with Policies or Gates (`$this->authorize()` / `Gate::allows()`).
- Never use raw unescaped SQL (`DB::raw`) with untrusted input; use parameter bindings.

### 3. Testing & Verification
- Run tests via Pest: `php artisan test` or `./vendor/bin/pest`.
- Ensure code style is formatted: `php artisan pint` or `./vendor/bin/pint`.
- Verify database migrations and seeders execute cleanly.
