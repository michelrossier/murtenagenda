<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Bebas+Neue&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        /* Modern CSS Reset */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Custom Properties */
        :root {
            --color-background: #8BA88F;
            --color-accent: #E6358F;
            --color-text: #2C3E50;
            --color-text-light: #6C7A89;
            --color-surface: #ffffff;
            --border-radius: 0px;
            --transition-speed: 0.3s;
            --font-display: 'Bebas Neue', sans-serif;
            --font-heading: 'Archivo Black', sans-serif;
            --font-body: 'Work Sans', sans-serif;
        }

        :root[data-theme="dark"] {
            --color-background: #1a1f1b;
            --color-accent: #ff5db1;
            --color-text: #ffffff;
            --color-text-light: #a8b3bd;
            --color-surface: #2c2c2c;
        }

        /* General styles */
        body {
            background-color: var(--color-background);
            font-family: var(--font-body);
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            color: var(--color-text);
            min-height: 100vh;
            perspective: 1000px;
            overflow-x: hidden;
            transition: background-color var(--transition-speed) ease,
                      color var(--transition-speed) ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            position: relative;
            transform-style: preserve-3d;
            will-change: transform;
            transition: transform 0.1s ease-out;
        }

        .container::before {
            content: '';
            position: fixed;
            top: 20px;
            left: 20px;
            width: 120px;
            height: 200px;
            background-image: url("data:image/svg+xml,%3Csvg width='120' height='200' viewBox='0 0 120 200' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 180c0-80 80-80 80-160' stroke='%23E6358F' stroke-width='2' stroke-linecap='round'/%3E%3Cpath d='M40 180c0-80 80-80 80-160' stroke='%23E6358F' stroke-width='2' stroke-linecap='round' opacity='.7'/%3E%3Cpath d='M60 180c0-80 80-80 80-160' stroke='%23E6358F' stroke-width='2' stroke-linecap='round' opacity='.4'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            pointer-events: none;
            z-index: -1;
            transform: translateZ(-20px);
            will-change: transform;
        }

        .container::after {
            content: '';
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 150px;
            height: 150px;
            background-image: url("data:image/svg+xml,%3Csvg width='150' height='150' viewBox='0 0 150 150' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='75' cy='75' r='60' stroke='%23E6358F' stroke-width='2' stroke-dasharray='4 6'/%3E%3Ccircle cx='75' cy='75' r='40' stroke='%23E6358F' stroke-width='2' stroke-dasharray='4 6' opacity='.7'/%3E%3Ccircle cx='75' cy='75' r='20' stroke='%23E6358F' stroke-width='2' stroke-dasharray='4 6' opacity='.4'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            pointer-events: none;
            z-index: -1;
            transform: translateZ(-30px);
            will-change: transform;
        }

        /* Filter form styles */
        .filter-form {
            position: relative;
            margin-bottom: 60px;
        }

        .filter-form::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg width='200' height='20' viewBox='0 0 200 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 10h200' stroke='%23E6358F' stroke-width='2' stroke-dasharray='2 4'/%3E%3Ccircle cx='100' cy='10' r='4' fill='%23E6358F'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
        }

        #date {
            background-color: white;
            border: 2px solid var(--color-accent);
            color: var(--color-text);
            padding: 12px 20px;
            font-size: 1rem;
            font-family: 'Space Grotesk', sans-serif;
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
            flex: 1;
            max-width: 200px;
        }

        #date:focus {
            outline: none;
            border-color: var(--color-accent);
            box-shadow: 0 0 0 3px rgba(230, 53, 143, 0.1);
        }

        button {
            background-color: var(--color-accent);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1.1rem;
            cursor: pointer;
            font-family: var(--font-display);
            font-weight: 400;
            text-transform: uppercase;
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
            letter-spacing: 1px;
        }

        button:hover {
            background-color: #d62839;
            transform: translateY(-1px);
        }

        /* Event list styles */
        .event-list {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .event-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            position: relative;
            border-bottom: none;
            background: url("data:image/svg+xml,%3Csvg width='100%25' height='12' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 6 C 30 2, 60 10, 90 6 C 120 2, 150 10, 180 6 C 210 2, 240 10, 270 6' stroke='%23E6358F' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") bottom repeat-x;
            background-size: 270px 12px;
            padding-bottom: 30px;
            margin-bottom: 10px;
            transform-style: preserve-3d;
            transform: translateZ(0);
            background-color: transparent;
        }

        .event-date {
            font-family: var(--font-display);
            font-weight: 400;
            font-size: 1.4rem;
            min-width: 80px;
            color: var(--color-accent);
            text-transform: uppercase;
            letter-spacing: 1px;
            transform: translateZ(10px);
            will-change: transform;
        }

        .event-weekday {
            display: block;
            color: var(--color-text);
            font-size: 1.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 4px;
            font-weight: 400;
            text-decoration: underline;
            text-decoration-color: var(--color-accent);
        }

        .event-name {
            color: var(--color-text);
            font-family: var(--font-heading);
            font-size: 2.2rem;
            font-weight: 400;
            margin-left: 40px;
            flex-grow: 1;
            line-height: 1.1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transform: translateZ(20px);
            will-change: transform;
        }

        .event-name span {
            display: inline-block;
            transition: color 0ms;
            transition-delay: 0ms;
        }

        .event-name:hover span {
            color: #B3176C;
        }

        .event-name:hover span:nth-child(1) { transition-delay: 0ms; }
        .event-name:hover span:nth-child(2) { transition-delay: 20ms; }
        .event-name:hover span:nth-child(3) { transition-delay: 40ms; }
        .event-name:hover span:nth-child(4) { transition-delay: 60ms; }
        .event-name:hover span:nth-child(5) { transition-delay: 80ms; }
        .event-name:hover span:nth-child(6) { transition-delay: 100ms; }
        .event-name:hover span:nth-child(7) { transition-delay: 120ms; }
        .event-name:hover span:nth-child(8) { transition-delay: 140ms; }
        .event-name:hover span:nth-child(9) { transition-delay: 160ms; }
        .event-name:hover span:nth-child(10) { transition-delay: 180ms; }
        .event-name:hover span:nth-child(11) { transition-delay: 200ms; }
        .event-name:hover span:nth-child(12) { transition-delay: 220ms; }
        .event-name:hover span:nth-child(13) { transition-delay: 240ms; }
        .event-name:hover span:nth-child(14) { transition-delay: 260ms; }
        .event-name:hover span:nth-child(15) { transition-delay: 280ms; }
        .event-name:hover span:nth-child(16) { transition-delay: 300ms; }
        .event-name:hover span:nth-child(17) { transition-delay: 320ms; }
        .event-name:hover span:nth-child(18) { transition-delay: 340ms; }
        .event-name:hover span:nth-child(19) { transition-delay: 360ms; }
        .event-name:hover span:nth-child(20) { transition-delay: 380ms; }

        .event-organizer {
            font-family: var(--font-display);
            font-size: 1.4rem;
            color: var(--color-accent);
            margin-top: 8px;
            letter-spacing: 1px;
        }

        .event-status {
            background-color: var(--color-accent);
            color: white;
            padding: 6px 12px;
            font-size: 0.9rem;
            margin-left: 16px;
            font-family: var(--font-display);
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            transform: translateZ(30px);
            will-change: transform;
        }

        .event-status::after {
            content: '';
            position: absolute;
            right: -10px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid var(--color-accent);
        }

        /* Pagination styles */
        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .pagination > * {
            padding: 8px 16px;
            background: white;
            color: var(--color-text);
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            border: 2px solid var(--color-accent);
        }

        .pagination > *:hover {
            background: var(--color-accent);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .event-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .event-name {
                margin-left: 0;
                font-size: 1.5rem;
            }

            .event-status {
                margin-left: 0;
                margin-top: 16px;
                align-self: flex-start;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            #date {
                max-width: none;
            }
        }

        /* Add a subtle animation to the background graphics */
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        .container::before {
            animation: float 8s ease-in-out infinite;
        }

        .container::after {
            animation: float 8s ease-in-out infinite reverse;
        }

        .event-date::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 0L13 7L20 10L13 13L10 20L7 13L0 10L7 7L10 0Z' fill='%23E6358F'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-item:hover .event-date::before {
            opacity: 1;
        }

        /* Add perspective for 3D transforms */
        body {
            perspective: 1000px;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            position: relative;
            transform-style: preserve-3d;
            will-change: transform;
            transition: transform 0.1s ease-out;
        }

        /* Adjust z-index and transform-style for all interactive elements */
        .event-item {
            transform-style: preserve-3d;
            transform: translateZ(0);
        }

        .event-name {
            transform: translateZ(20px);
            will-change: transform;
        }

        .event-date {
            transform: translateZ(10px);
            will-change: transform;
        }

        .event-status {
            transform: translateZ(30px);
            will-change: transform;
        }

        /* Background decorative elements with different parallax depths */
        .container::before {
            transform: translateZ(-20px);
            will-change: transform;
        }

        .container::after {
            transform: translateZ(-30px);
            will-change: transform;
        }

        /* Add letter filter styles */
        .letter-filter {
            margin: 20px 0 40px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            position: relative;
        }

        .letter-filter::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg width='200' height='20' viewBox='0 0 200 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 10h200' stroke='%23E6358F' stroke-width='2' stroke-dasharray='2 4'/%3E%3Ccircle cx='100' cy='10' r='4' fill='%23E6358F'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
        }

        .letter-filter a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: var(--color-surface);
            color: var(--color-text);
            text-decoration: none;
            border: 2px solid var(--color-accent);
            font-family: var(--font-display);
            font-size: 1.2rem;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
        }

        .letter-filter a:hover,
        .letter-filter a.active {
            background-color: var(--color-accent);
            color: white;
            transform: translateY(-2px);
        }

        .letter-filter a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .letter-filter a:hover::before {
            left: 100%;
        }

        /* Add animation styles */
        @keyframes fadeUpOut {
            0% {
                opacity: 1;
                transform: translateY(0) translateZ(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-20px) translateZ(0);
            }
        }

        @keyframes fadeUpIn {
            0% {
                opacity: 0;
                transform: translateY(20px) translateZ(0);
            }
            100% {
                opacity: 1;
                transform: translateY(0) translateZ(0);
            }
        }

        @keyframes fadeDownOut {
            0% {
                opacity: 1;
                transform: translateY(0) translateZ(0);
            }
            100% {
                opacity: 0;
                transform: translateY(20px) translateZ(0);
            }
        }

        @keyframes fadeDownIn {
            0% {
                opacity: 0;
                transform: translateY(-20px) translateZ(0);
            }
            100% {
                opacity: 1;
                transform: translateY(0) translateZ(0);
            }
        }

        .event-item {
            animation: fadeUpIn 0.3s ease forwards;
        }

        .event-item.fade-out {
            animation: fadeUpOut 0.1s ease forwards;
        }

        .event-item.fade-down-out {
            animation: fadeDownOut 0.1s ease forwards;
        }

        .event-item.fade-down-in {
            animation: fadeDownIn 0.3s ease forwards;
        }

        /* Add floating leaves background */
        .floating-leaves {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .leaf {
            position: absolute;
            width: 40px;
            height: 40px;
            background-repeat: no-repeat;
            opacity: 0.15;
            will-change: transform;
        }

        .leaf-1 {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 2C12 2 2 12 2 20C2 28 12 38 20 38C28 38 38 28 38 20C38 12 28 2 20 2ZM20 25C17.2 25 15 22.8 15 20C15 17.2 17.2 15 20 15C22.8 15 25 17.2 25 20C25 22.8 22.8 25 20 25Z' fill='%23E6358F'/%3E%3C/svg%3E");
        }

        .leaf-2 {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M38 20C38 12 30 2 20 2C10 2 2 12 2 20C2 28 10 38 20 38C30 38 38 28 38 20ZM20 30C14.5 30 10 25.5 10 20C10 14.5 14.5 10 20 10C25.5 10 30 14.5 30 20C30 25.5 25.5 30 20 30Z' fill='%23E6358F'/%3E%3C/svg%3E");
        }

        .leaf-3 {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 2L2 20L20 38L38 20L20 2Z' fill='%23E6358F'/%3E%3C/svg%3E");
        }

        @keyframes floatLeaf {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(10px, 10px) rotate(5deg);
            }
            50% {
                transform: translate(0, 20px) rotate(0deg);
            }
            75% {
                transform: translate(-10px, 10px) rotate(-5deg);
            }
        }

        /* Theme toggle styles */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--color-surface);
            border: 2px solid var(--color-accent);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            padding: 0;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(230, 53, 143, 0.3);
        }

        .theme-toggle svg {
            width: 24px;
            height: 24px;
            transition: all var(--transition-speed) ease;
        }

        .theme-toggle .sun,
        .theme-toggle .moon {
            position: absolute;
            transition: all var(--transition-speed) ease;
        }

        .theme-toggle .sun path {
            fill: var(--color-accent);
        }

        .theme-toggle .moon path {
            fill: var(--color-accent);
        }

        [data-theme="dark"] .theme-toggle .sun {
            opacity: 0;
            transform: rotate(90deg);
        }

        [data-theme="light"] .theme-toggle .moon {
            opacity: 0;
            transform: rotate(-90deg);
        }
    </style>
</head>
<body>
    <button class="theme-toggle" aria-label="Toggle theme">
        <svg class="sun" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1zm0 14a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1zm9-9a1 1 0 0 1-1 1h-2a1 1 0 1 1 0-2h2a1 1 0 0 1 1 1zM4 8a1 1 0 0 1-1 1H1a1 1 0 1 1 0-2h2a1 1 0 0 1 1 1zm16.364 7.364a1 1 0 0 1-1.414 0l-1.414-1.414a1 1 0 0 1 1.414-1.414l1.414 1.414a1 1 0 0 1 0 1.414zM6.343 6.343a1 1 0 0 1-1.414 0L3.515 4.929a1 1 0 0 1 1.414-1.414l1.414 1.414a1 1 0 0 1 0 1.414zm12.728 1.414a1 1 0 0 1-1.414-1.414l1.414-1.414a1 1 0 0 1 1.414 1.414l-1.414 1.414zM6.343 17.657a1 1 0 0 1 0-1.414l1.414-1.414a1 1 0 0 1 1.414 1.414l-1.414 1.414a1 1 0 0 1-1.414 0zM12 6a6 6 0 1 0 0 12 6 6 0 0 0 0-12z"/>
        </svg>
        <svg class="moon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.1 22c-4.9 0-9-3.9-9.1-8.8 0-3.5 2-6.7 5.1-8.1.3-.1.7 0 .9.3.2.3.1.7-.1 1-1.2 1.6-1.9 3.6-1.8 5.6 0 5 4.1 9 9.1 9 1.2 0 2.4-.2 3.5-.7.3-.1.7 0 .9.3.2.3.1.7-.1 1-2.3 1.5-5 2.4-7.7 2.4z"/>
        </svg>
    </button>

    <div class="floating-leaves">
        <!-- Leaves will be added here via JavaScript -->
    </div>
    <div class="container">
        <form action="{{ route('events.index') }}" method="GET" class="filter-form">
            <input type="date" id="date" name="date" value="{{ request('date') }}">
            <button type="submit">Filter</button>
        </form>

        <div class="letter-filter">
            @foreach($availableLetters as $letter)
                <a href="#" 
                   data-letter="{{ $letter }}"
                   @if(request('letter') === $letter) class="active" @endif>
                    {{ $letter }}
                </a>
            @endforeach
            @if(request()->has('letter'))
                <a href="#" 
                   data-letter="all"
                   style="width: auto; padding: 0 12px;">
                    Alle
                </a>
            @endif
        </div>

        <ul class="event-list">
            @foreach($events as $event)
                <li class="event-item">
                    <div class="event-date">
                        <span class="event-weekday">{{ $event->date->format('D') }}</span>
                        {{ $event->date->format('d.m.') }}
                    </div>
                    <div class="event-name" data-text="{{ $event->name }}">
                        {{ $event->name }}
                        @if($event->organizer)
                            <div class="event-organizer">& {{ $event->organizer }}</div>
                        @endif
                    </div>
                    @if($event->status === 'sold_out')
                        <span class="event-status">AUSVERKAUFT</span>
                    @endif
                    @if($event->status === 'postponed')
                        <span class="event-status">VERSCHOBEN</span>
                    @endif
                </li>
            @endforeach
        </ul>

        {{ $events->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create floating leaves with GSAP animations
            const leavesContainer = document.querySelector('.floating-leaves');
            const numLeaves = 15;

            function createLeaf() {
                const leaf = document.createElement('div');
                leaf.className = `leaf leaf-${Math.floor(Math.random() * 3) + 1}`;
                
                // Random initial position
                const startX = Math.random() * 100;
                const startY = Math.random() * 100;
                
                // Random size between 30-60px
                const size = 30 + Math.random() * 30;
                leaf.style.width = `${size}px`;
                leaf.style.height = `${size}px`;
                
                // Set initial position
                gsap.set(leaf, {
                    x: `${startX}vw`,
                    y: `${startY}vh`,
                    rotation: Math.random() * 360
                });
                
                leavesContainer.appendChild(leaf);

                // Create random waypoints for natural movement
                const waypoints = Array.from({ length: 4 }, () => ({
                    x: startX + (Math.random() * 20 - 10),
                    y: startY + (Math.random() * 20 - 10),
                    rotation: Math.random() * 30 - 15
                }));

                // Create timeline for this leaf
                const tl = gsap.timeline({
                    repeat: -1,
                    defaults: { ease: "none" }
                });

                // Add waypoints to timeline
                waypoints.forEach((point, index) => {
                    tl.to(leaf, {
                        duration: 10 + Math.random() * 20,
                        x: `${point.x}vw`,
                        y: `${point.y}vh`,
                        rotation: point.rotation,
                        ease: "sine.inOut"
                    });
                });

                // Add subtle continuous rotation
                gsap.to(leaf, {
                    rotation: "+=360",
                    duration: 60 + Math.random() * 60,
                    repeat: -1,
                    ease: "none"
                });

                // Add subtle scale breathing effect
                gsap.to(leaf, {
                    scale: 1.1,
                    duration: 2 + Math.random() * 2,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                });
            }

            // Create leaves
            for (let i = 0; i < numLeaves; i++) {
                createLeaf();
            }

            const eventNames = document.querySelectorAll('.event-name');
            
            eventNames.forEach(eventName => {
                const text = eventName.dataset.text;
                const letters = text.split('');
                
                const organizerDiv = eventName.querySelector('.event-organizer');
                eventName.textContent = '';
                
                letters.forEach(letter => {
                    const span = document.createElement('span');
                    span.textContent = letter;
                    eventName.appendChild(span);
                });
                
                if (organizerDiv) {
                    eventName.appendChild(organizerDiv);
                }
            });

            // Add parallax effect
            const container = document.querySelector('.container');
            let bounds = container.getBoundingClientRect();
            const centerX = bounds.width / 2;
            const centerY = bounds.height / 2;
            
            // Update bounds on resize
            window.addEventListener('resize', () => {
                bounds = container.getBoundingClientRect();
            });

            // Track mouse movement
            document.addEventListener('mousemove', (e) => {
                // Calculate mouse position relative to container center
                const mouseX = e.clientX - bounds.left - centerX;
                const mouseY = e.clientY - bounds.top - centerY;
                
                // Calculate rotation angles (reduced for subtlety)
                const rotateX = (mouseY / centerY) * -3; // Max 3 degrees
                const rotateY = (mouseX / centerX) * 3; // Max 3 degrees
                
                // Apply transform with easing
                requestAnimationFrame(() => {
                    container.style.transform = `
                        rotateX(${rotateX}deg)
                        rotateY(${rotateY}deg)
                        translateZ(0)
                    `;
                });
            });

            // Reset transform when mouse leaves
            document.addEventListener('mouseleave', () => {
                container.style.transform = `
                    rotateX(0deg)
                    rotateY(0deg)
                    translateZ(0)
                `;
            });

            // Add letter filter handling
            const letterFilter = document.querySelector('.letter-filter');
            const eventList = document.querySelector('.event-list');
            
            letterFilter.addEventListener('click', async function(e) {
                e.preventDefault();
                if (!e.target.matches('a')) return;

                // Update active state
                letterFilter.querySelectorAll('a').forEach(a => a.classList.remove('active'));
                e.target.classList.add('active');

                const letter = e.target.dataset.letter;
                const currentUrl = new URL(window.location.href);
                
                // Determine animation direction based on filter type
                const isAllFilter = letter === 'all';
                const fadeOutClass = isAllFilter ? 'fade-down-out' : 'fade-out';
                
                // Fade out current items
                const currentItems = document.querySelectorAll('.event-item');
                currentItems.forEach(item => {
                    item.classList.remove('fade-out', 'fade-down-out', 'fade-up-in', 'fade-down-in');
                    item.classList.add(fadeOutClass);
                });

                // Wait for fade out animation
                await new Promise(resolve => setTimeout(resolve, 100));

                // Update URL and fetch new content
                if (letter === 'all') {
                    currentUrl.searchParams.delete('letter');
                } else {
                    currentUrl.searchParams.set('letter', letter);
                }
                
                // Preserve other query parameters like date
                window.history.pushState({}, '', currentUrl);

                // Fetch new content
                const response = await fetch(currentUrl);
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Replace event list content
                eventList.innerHTML = doc.querySelector('.event-list').innerHTML;

                // Apply the appropriate fade-in animation to new items
                const newItems = document.querySelectorAll('.event-item');
                newItems.forEach(item => {
                    item.classList.remove('fade-out', 'fade-down-out', 'fade-up-in', 'fade-down-in');
                    item.classList.add(isAllFilter ? 'fade-down-in' : 'fade-up-in');
                });

                // Initialize event name animations for new content
                const eventNames = document.querySelectorAll('.event-name');
                eventNames.forEach(eventName => {
                    const text = eventName.dataset.text;
                    const letters = text.split('');
                    const organizerDiv = eventName.querySelector('.event-organizer');
                    eventName.textContent = '';
                    
                    letters.forEach(letter => {
                        const span = document.createElement('span');
                        span.textContent = letter;
                        eventName.appendChild(span);
                    });
                    
                    if (organizerDiv) {
                        eventName.appendChild(organizerDiv);
                    }
                });
            });

            // Theme toggle functionality
            const themeToggle = document.querySelector('.theme-toggle');
            const root = document.documentElement;
            
            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            root.setAttribute('data-theme', savedTheme);

            themeToggle.addEventListener('click', () => {
                const currentTheme = root.getAttribute('data-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                
                // Animate the transition
                gsap.to(root, {
                    '--color-background': newTheme === 'dark' ? '#1a1f1b' : '#8BA88F',
                    '--color-accent': newTheme === 'dark' ? '#ff5db1' : '#E6358F',
                    duration: 0.5,
                    ease: 'power2.inOut'
                });

                root.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);

                // Animate the icons
                if (newTheme === 'dark') {
                    gsap.to('.sun', { opacity: 0, rotate: 90, duration: 0.5 });
                    gsap.to('.moon', { opacity: 1, rotate: 0, duration: 0.5 });
                } else {
                    gsap.to('.sun', { opacity: 1, rotate: 0, duration: 0.5 });
                    gsap.to('.moon', { opacity: 0, rotate: -90, duration: 0.5 });
                }
            });
        });
    </script>
</body>
</html> 