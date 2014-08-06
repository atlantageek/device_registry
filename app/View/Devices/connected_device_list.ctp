<?php
?>
<script type="text/javascript" class="init">
    $(document).ready(function() {
	    $('#report_table').dataTable({
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "/devices/connected_device_list.json",
    "aoColumns": [
        {mData:"Device.id"},
        {mData:"Device.sn"},
        {mData:"Device.first_name"},
        {mData:"Device.last_name"},
        {mData:"Device.garage"},
        {mData:"Device.city"},
        {mData:"Device.state"},
        {mData:"Device.service_date"},
        {mData:"Device.fw"},
        {mData:"Device.hw"},
        {mData:"Device.cal_date"},
        {mData:"Device.vz_id"},
        {mData:"Device.config_file"},
        {mData:"Device.ch_plan"},
        {mData:"Device.updated"}
    ],
	    });
    } );
</script>

<div class="body">
<table id="report_table" border=1 cellspacing=0 cellpadding=0>
<thead>
<tr>
<th>ID</th>
<th>SN</th>
<th>First Name</th>
<th>Last Name</th>
<th>Garage</th>
<th>City</th>
<th>State</th>
<th>Service Date</th>
<th>Firmware</th>
<th>Hardware</th>
<th>Cal. Date</th>
<th>VZid</th>
<th>Config File</th>
<th>Channel Plan</th>
<th>Updated</th>
</tr>
</thead>
<tbody>
 </tbody></table>
 </div>
