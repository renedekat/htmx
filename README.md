## About HTMX Playground

Based on the example at https://tighten.com/insights/use-htmx-to-create-laravel-single-page-apps-without-writing-javascript/


## Installation and configuration

- Clone the repo
- Create a database of your liking and configure it. Defaults to sqlite.
- `cp .env.example .env`
- `composer install`
- `npm install`
- `php artisan key:generate`
- `php artisan migrate`

Update your .env file for Reverb

- REVERB_APP_ID=
- REVERB_APP_KEY=
- REVERB_APP_SECRET=

On your local machine you might have to set verify_peer for Push to false
REVERB_VERIFY=false

## Usage
Events are broadcast via a queue. You can change this in Events/*.php by changing

`use Illuminate\Contracts\Broadcasting\ShouldBroadcast;`

to

`use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;`

and also updating the `implements` interface.

However, using the queue is more scalable.

Start the queue worker: `php artisan queue work`<br>
In a different terminal run `php artisan reverb:start --debug  --host="0.0.0.0" --hostname="htmx.test"`<br>
In a different terminal run `npm run dev` or `npm run build` if you're not planning on making changes

