@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Hangry">
<!-- <img src="../images/hangry-logo-orange-bg.png" class="logo" alt="Hangry Logo"> -->
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
