# Murten Agenda

A beautiful event listing application for events in the Murten region. Features a modern, interactive UI with smooth animations and dark mode support.

## Features

- 🎨 Modern, responsive design with 3D parallax effects
- 🌓 Dark mode with smooth transitions
- 🍃 Decorative floating leaves background
- 📅 Date-based event filtering
- 🔤 Alphabetical filtering with smooth animations
- 🔄 AJAX-powered content updates
- 🎯 Event scraping from regional sources

## Technologies

- Laravel 10
- GSAP (GreenSock Animation Platform)
- Custom CSS with CSS Variables
- Vanilla JavaScript
- DDEV for local development

## Setup

1. Clone the repository:
```bash
git clone https://github.com/YOUR_USERNAME/murtenagenda.git
cd murtenagenda
```

2. Install dependencies:
```bash
composer install
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Start DDEV:
```bash
ddev start
ddev composer install
```

5. Run migrations:
```bash
ddev exec php artisan migrate
```

6. Scrape initial events:
```bash
ddev exec php artisan events:scrape
```

## Development

The application uses DDEV for local development. Key commands:

- `ddev start` - Start the development environment
- `ddev stop` - Stop the development environment
- `ddev exec php artisan events:scrape` - Update events from sources

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
