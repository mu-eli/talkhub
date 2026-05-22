# TalkHub — Learning English Simplified

> TalkHub, an online English learning platform connecting ESL learners with native tutors for 1-on-1 lessons.

🌐 **Live site:** [talkhub-eng.netlify.app](https://talkhub-eng.netlify.app)

---

## About the Project

TalkHub is a frontend website built for an online English tutoring platform based in Turkey. The site presents the platform's tutors, lesson packages, and contact form, with a focus on accessibility and responsive design.

---

## Pages

| `index.html` | Homepage — hero section, how it works, student testimonials, tutor intro |
| `about.html` | Mission, vision, and why TalkHub |
| `tutors.html` | Meet the tutors |
| `packages.html` | Pricing plans and what learners will study |
| `contact.html` | Contact form with PHP backend handler |

---

## Tech Stack

- **HTML5** — semantic markup
- **CSS3** — custom properties, grid, flexbox, responsive design
- **JavaScript** — mobile nav, active link highlighting, form status alerts
- **PHP** — contact form handler (`contact.php`) with server-side validation, email sending, and auto-reply
- **Ionicons** — icon library
- **Google Fonts** — Rubik, Lexend Zetta, Sansita Swashed
- **Netlify** — deployment and hosting

---

## Features

- Fully responsive across mobile, tablet, and desktop
- Mobile hamburger navigation
- Active nav link highlighting per page
- Contact form with:
  - Client-side HTML5 validation
  - Server-side PHP validation and sanitisation
  - Auto-reply email to the visitor
  - Success/error status message after submission
- PWA-ready (`manifest.webmanifest`, favicon, apple touch icon)

---

## Contact Form Setup

The contact form uses a separate PHP file to keep HTML and backend logic apart.

1. Upload all files to a PHP-enabled host (e.g. cPanel shared hosting)
2. Open `contact.php` and update the configuration at the top:

```php
$to          = "your@email.com";   // receiving email
$site_name   = "TalkHub";
$from_domain = "yourdomain.com";   // your domain
```

3. The form in `contact.html` posts to `contact.php`, which:
   - Validates and sanitises all fields
   - Sends the message to your inbox with `Reply-To` set to the visitor
   - Sends an auto-reply to the visitor
   - Redirects back to `contact.html?status=success` or `?status=error`

> **Note:** `mail()` requires a configured mail agent on the server. For more reliable delivery, consider replacing it with [PHPMailer + SMTP](https://github.com/PHPMailer/PHPMailer).

---

## Deployment

The static pages are deployed on **Netlify**. Note that Netlify does not support PHP — to use the contact form in production, host it on a PHP-enabled server or replace `contact.php` with a service like [Formspree](https://formspree.io) or [Netlify Forms](https://www.netlify.com/products/forms/).

---

## Social

- Instagram: [@talkhubenglish](https://www.instagram.com/talkhubenglish/)
- TikTok: [@talkhubenglish](https://www.tiktok.com/@talkhubenglish)

---

## License

This project is for personal/commercial use by TalkHub. All rights reserved.
