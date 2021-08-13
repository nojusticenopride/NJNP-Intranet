<?php
/**
* Template part for displaying the header to the task list
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/
?>
 <?php get_template_part( 'templates/task', 'form'); ?>
<h4>Tasks</h4>
<div class="btn-toolbar mx-2" role="toolbar" aria-label="Toolbar with button groups">
  <div class="input-group filter-button-group input-group-sm mb-3 me-2" role="group" aria-label="First group">
    <span class="input-group-text" id="basic-addon2">Filter by status</span>
    <button class="btn btn-sm btn-outline-info"
            type="button"
            data-mdb-ripple-color="dark"
            data-filter="*">

      Reset
    </button>
    <button type="button" class="ms-4 btn shadow-0 btn-sm btn-warning" data-filter=".Pending">Pending</button>
    <button type="button" class="btn shadow-0 btn-sm btn-warning" data-filter=".Not-Started">Not-Started</button>
    <button type="button" class="btn shadow-0 btn-sm btn-warning" data-filter=".In-Process">In-Process</button>
    <button type="button" class="btn shadow-0 btn-sm btn-warning" data-filter=".In-Review">In-Review</button>
  </div>
  <div class="btn-group ms-5 me-2 btn-group-sm filter-button-group input-group-sm mb-3" role="group" aria-label="sec ond group">           
    <button type="button" class="btn text-dark btn-sm btn-outline-success" data-filter=".Completed">All Completed tasks</button> 
    <button type="button" class="btn text-dark btn-sm btn-outline-warning" data-filter=":not(.Completed)">All In-Complete tasks</button> 
  </div>
</div>