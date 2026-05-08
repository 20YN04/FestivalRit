# 🎟️ FestivalRit

> Vind je rit naar het festival. Stap mee, deel de kosten, kom samen aan.

FestivalRit is a Belgian-first ride-sharing app for festivals. Drivers post the
seats they have free, festival-goers grab them. Built in Laravel 13 with
Blade components, Tailwind v4 and a sqlite database.

---

## 🧠 Concept

### What problem does this solve?

Every Belgian festival weekend (Tomorrowland, Pukkelpop, Rock Werchter,
Graspop, Couleur Café, …) tens of thousands of people drive empty cars
to the same patch of grass. The rest of the country is stuck on:

- Crowded NMBS shuttles that stop running at 23:00 — useless if your headliner
  closes at 02:00.
- A De Lijn schedule that turns a 40-min ride into a 3-hour ordeal.
- BlaBlaCar, which is generic, French, and not optimised for festival logistics
  (no festival-as-destination, no "last seat" urgency, no Belgian city defaults).

FestivalRit fills that gap with a focused product: **one driver, one festival,
one departure city, X open seats**. Nothing more, nothing less.

### Why does this matter in Belgium?

- Belgium hosts ~30 large summer festivals across a country smaller than
  Wallonia + Flanders combined — perfect carpool distance.
- Public transport gaps after midnight are a documented pain point
  (NMBS *Festival Express* shuttles only cover the biggest events).
- A full car with 4 passengers cuts CO₂ per head by ~75 % vs solo driving.
- Belgian festival culture is social by default — sharing a car is a feature,
  not a friction.

### Who are the users?

| Persona | Goal |
|--------|------|
| **The driver** | Has 3 free seats, wants to split fuel, doesn't want to be alone in the car for 90 min. |
| **The passenger** | Stuck without wheels, public transport stops too early, willing to chip in 15 EUR. |
| **The festival organiser (future)** | Wants to reduce parking pressure and CO₂ footprint. |

---

## ⚙️ Installation

### Requirements

- PHP **8.4+** (Laravel 13 minimum)
- Composer 2.x
- Node.js 20+ and npm
- SQLite (ships with PHP — no install needed)
- *(optional)* [Laravel Herd](https://herd.laravel.com) — recommended on macOS

### 1. Clone & install dependencies

```bash
git clone https://github.com/20YN04/FestivalRit.git
cd FestivalRit

composer install
npm install
```

### 2. Environment

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and confirm these values (defaults are fine for local dev):

| Variable | Value | Purpose |
|---|---|---|
| `APP_NAME` | `FestivalRit` | Shown in browser tab |
| `APP_URL` | `http://localhost:8000` (or your Herd URL) | Used for route generation |
| `APP_LOCALE` | `nl` *(recommended)* | Dutch month/day formatting via Carbon |
| `DB_CONNECTION` | `sqlite` | The DB driver — no host/port/user needed |

No external services are required. No API keys, no mail server, no Redis.
The whole stack runs offline.

### 3. Database & seeding

```bash
# create the sqlite file (already committed empty in repo, but safe to re-run)
touch database/database.sqlite

# run all migrations (festivals, rides, seat-tracking, plus the Laravel defaults)
php artisan migrate

# seed realistic Belgian data (3 named festivals + ~12 rides)
php artisan db:seed
```

To wipe everything and reseed in one shot:

```bash
php artisan migrate:fresh --seed
```

### 4. Build front-end & run

```bash
# dev: Vite HMR + Tailwind v4 + Laravel
npm run dev
# in another terminal:
php artisan serve
```

…or, with Herd, just visit `https://festivalrit.test` — no `serve` needed.

For a production-style build:

```bash
npm run build
php artisan serve
```

Open the app at <http://localhost:8000>. The root `/` redirects to
`/festivals`.

---

## 🧪 Usage

### What's in the box

| Route | Method | What it does |
|---|---|---|
| `/festivals` | GET | Hero + grid of all festivals (paginated 12/page) |
| `/festivals/create` | GET/POST | Add a festival (name + location) |
| `/festivals/{id}` | GET | Festival detail with poster + ride list |
| `/festivals/{id}/edit` | GET/PUT | Edit a festival |
| `/festivals/{id}` | DELETE | Remove festival (cascades to rides) |
| `/rides` | GET | All rides as ticket cards. Supports `?festival_id=X` filter. (paginated 10/page) |
| `/rides/create` | GET/POST | Offer a new ride (seats, departure city, time, …) |
| `/rides/{id}` | GET | Boarding-pass detail page |
| `/rides/{id}/edit` | GET/PUT | Edit a ride |
| `/rides/{id}` | DELETE | Remove a ride |

### Example scenarios

**Scenario 1 — "I'm driving from Genk to Pukkelpop, 3 free seats."**

1. Go to `/rides/create`.
2. Pick festival = Pukkelpop, departure city = Genk, total seats = 4,
   already booked = 1 (you), departure time = Friday 10:00.
3. Add a description ("vertrek vanaf parking C3 Genk-Zuid").
4. Submit → land on the ride detail page.

**Scenario 2 — "I'm a Tomorrowland passenger looking for a lift."**

1. Go to `/rides`.
2. Pick *Tomorrowland* in the filter dropdown → submit.
3. Browse the ticket cards. Green badge = seats free, magenta pulse = last seat,
   coral = volzet.
4. Click a ticket → see driver, time, full description.

**Scenario 3 — "Last-minute, only one seat left."**

The seat badge automatically becomes a magenta "Laatste plaats" pulse when
`seats_available <= 1`, drawing the eye. Once `booked_seats == total_seats`
the ride flips to "Volzet" coral and visually dims out of urgency.

---

## 🔥 Momentum factor — what makes this powerful?

### Already in the build

- **Live seat tracking** — every ride exposes `seats_available` and `is_full`
  as model accessors. The UI reacts instantly: green → magenta pulse → coral
  volzet, no manual flag.
- **Filter as URL state** — `/rides?festival_id=2&page=3` is a shareable link
  thanks to `paginate()->withQueryString()`. Send a friend a single URL and
  they land on exactly the right ride list.
- **Ticket-stub aesthetic** — every ride is a boarding pass: perforated
  divider, departure → destination eyebrow, big gradient seat counter.
  The UI tells you it's a ticket without anyone reading a label.
- **Festival posters generated from the festival name hash** — eight curated
  gradient themes (Tomorrowland-magenta, Werchter-grass, Graspop-ember, …)
  picked by `crc32($festival->name)`. Zero asset uploads, every festival
  looks distinct.
- **Belgian-default seed data** — the seeder ships the actual line-up:
  Pukkelpop / Kiewit, Rock Werchter / Werchter, Tomorrowland / Boom + factory
  fillers in cities like Genk, Antwerpen, Leuven, Mechelen.

### How this scales into a real product

| Today | V2 — easy unlock | V3 — real business |
|---|---|---|
| Anonymous CRUD | Auth + driver profiles, ride history | Driver verification (eID/itsme) |
| `booked_seats` is a number | `Booking` model: passenger ↔ ride pivot, status (pending/confirmed/cancelled) | Stripe payments per seat, Wise payout to driver |
| URL filter | Search by departure city + radius (Postgres `earthdistance`) | Live route matching with Google Maps Directions API |
| Static badges | Real-time seat updates over Laravel Reverb (websockets) | Push notifications on new ride / fill |
| Belgian festivals only | User-submitted festivals, moderation queue | Partnership with Live Nation / Sportpaleis: official ride hub per event |
| One language | Localised NL / FR / EN | De Lijn / NMBS comparison ("trein 23:00, deze rit 02:30 +12 EUR") |

The killer move at V3: a **green-points** programme tied to Belgian climate
incentives. Each shared seat = X kg CO₂ saved, redeemable for festival
discounts in partnership with the organisers. Suddenly carpooling isn't
just cheaper, it's the *cool* option.

---

## 🏗️ Project structure (the parts that matter)

```
app/
├── Http/Controllers/
│   ├── FestivalController.php   # resource controller, paginate(12)
│   └── RideController.php       # resource + festival_id filter (meaningful feature)
└── Models/
    ├── Festival.php             # hasMany(Ride) + HasFactory
    └── Ride.php                 # belongsTo(Festival), seats_available + is_full accessors

database/
├── factories/                   # FestivalFactory, RideFactory (faker)
├── migrations/                  # festivals, rides, rename available→total + booked
└── seeders/                     # FestivalSeeder (canonical), RideSeeder (story rides + fillers)

resources/views/
├── components/                  # Blade components — the design system
│   ├── layout.blade.php         # <x-layout> — sticky nav, hero footer, gradient body
│   ├── button.blade.php         # primary gradient / secondary glass / ghost / danger / acid
│   ├── card.blade.php           # dark glass with eyebrow
│   ├── input.blade.php          # dark with focus glow
│   ├── nav-link.blade.php       # active = inverted ink chip
│   ├── seat-badge.blade.php     # green / magenta-pulse / coral-volzet
│   ├── festival-poster.blade.php # 8 gradient themes, crc32 hash → theme
│   ├── ride-ticket.blade.php    # boarding-pass card with perforated divider
│   ├── ride-form.blade.php      # shared create/edit form
│   └── textarea.blade.php
├── festivals/                   # index, show, create, edit
├── rides/                       # index, show, create, edit
└── vendor/pagination/
    └── tailwind.blade.php       # custom dark paginator with gradient active page
```

---

## ✅ Assignment checklist

| Requirement | Where |
|---|---|
| Latest Laravel | `composer.json` → `laravel/framework: ^13.7` |
| ≥ 2 models with relationship | `Festival hasMany Ride`, `Ride belongsTo Festival` |
| RESTful structure | `Route::resource('festivals', …)` + `Route::resource('rides', …)` in `routes/web.php` |
| Blade UI | `resources/views/**` — full component library, dark premium aesthetic |
| Proper migrations | `database/migrations/*_create_festivals_table.php`, `*_create_rides_table.php`, `*_rename_available_seats_and_add_booked_seats_to_rides.php` |
| ≥ 1 relationship | One-to-many Festival → Rides with `onDelete('cascade')` |
| Realistic seeders | `FestivalSeeder` (3 canonical Belgian festivals) + `RideSeeder` (4 hand-written rides + factory fillers) |
| Full CRUD | Festival **and** Ride both have full create / read / update / delete |
| Meaningful feature | `RideController::index()` filters rides by `festival_id` query param, with paginated, query-string-preserving results |

---

## 🛠️ Stack

- **Backend** — Laravel 13.7, PHP 8.4, SQLite
- **Frontend** — Blade components, Tailwind CSS v4, Vite 8, Bunny Fonts
  (Big Shoulders Display + Familjen Grotesk + JetBrains Mono)
- **Tooling** — Laravel Herd (local), Concurrently for `npm run dev`

---

## 📜 License

MIT.
