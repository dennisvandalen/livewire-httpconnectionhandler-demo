# Demo repo for livewire [PR #4570](https://github.com/livewire/livewire/pull/4570)

To see the broken demo visit the `/welcome` route without making changes to the `web.php` routes file.

This repo demo's 2 cases of broken livewire calls:

* Broken when there is no root route
* Broken when the root for authenticated users only

Uncomment some code in `web.php` to break and fix different parts.

> Demo of the PR fix: Uncomment line 17-19 in `AppServiceProvider`
