<?php
/**
* Template part for creating tasks from the project page
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/
?>
<div class="spinner-border load-acf text-warning d-none mt-3" role="status">
  <span class="visually-hidden">Loading...</span>
</div>


<div class="the-acf-form invisible">
  <!-- Buttons trigger collapse -->

  <!-- Collapsed content -->
  <div class="collapse acfcollapse show" id="add-task">
    <div class="new-task-card">
      <section class="bg-light py-2 px-5">
        <div class="container">
          <div class="card">
            <div class="card-body">
              <?php acfe_form('new-task'); ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>