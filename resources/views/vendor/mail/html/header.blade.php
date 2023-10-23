@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/dist/images/logo-kominfo.png') }}" class="logo" alt="Kominfo Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
