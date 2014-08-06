<?php
?>
<script type="text/javascript" class="init">
    $(document).ready(function() {
	    $('#report_table').dataTable({
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "/devices/index.json",
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
	    $('#connected_table').dataTable({
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
	    $('#unconnected_table').dataTable({
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "/devices/unconnected_device_list.json",
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
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li><a href="#all" class="active" role="tab" data-toggle="tab">All Devices</a></li>
  <li><a href="#connected" role="tab" data-toggle="tab">Connected</a></li>
  <li><a href="#unconnected" role="tab" data-toggle="tab">Unconnected</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="all">
<h3> All Devices</h3>
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
  <div class="tab-pane" id="connected">
<h3> Connected Devices</h3>
<table id="connected_table" border=1 cellspacing=0 cellpadding=0>
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
  <div class="tab-pane" id="unconnected">
<h3> Unconnected Devices</h3>
<table id="unconnected_table" border=1 cellspacing=0 cellpadding=0>
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
</div>
