<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'BIBIT-BALITTAS')
<img src="http://balittas.litbang.pertanian.go.id/images/Logo-Kementerian-Pertanian.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
