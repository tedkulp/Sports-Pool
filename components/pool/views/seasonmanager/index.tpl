<link rel="stylesheet" href="/css/style.css" type="text/css">
<h1>List Teams</h1>

{link action='edit' text='Create new season'}
<table class="hor-zebra" id="hor-zebra">
<tr>
	<th>Name</th>
	<th>Start - End</th>
	<th>Action</th>
</tr>
{foreach from=$seasons item=season key=key}
{strip}
   <tr class="{cycle values="even, odd"}">
      <td>{$season.name}</td>
      <td>{$season.start_year} - {$season.end_year}</td>
      
	  <td>
	  	{link action='edit' text='Edit' id=$season->id}<br />
	  	{link action='manage' text='Manage' id=$season->id}
	  </td>
   </tr>
{/strip}
{/foreach}
</table>

<!-- Probably a better way to do this -->
