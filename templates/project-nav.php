<?php
/**
* Template part for displaying project nav
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package BuddyBoss_Theme
*/

$projectType = $args['nav-options'];?>
<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
 
    


    <ul class="nav navbar-nav w-100 d-flex  justify-content-around" id="project-details" role="tablist">
      <li class="nav-item" role="presentation">
        <a
          class="nav-link active"
          id="task"
          data-mdb-toggle="tab"
          href="#tasks"
          role="tab"
          aria-controls="tasks"
          aria-selected="true"><i class="fas fa-tasks"></i> <span class="d-none d-md-inline">Tasks</span></a
        >
      </li>
        
          <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="Discuss"
          data-mdb-toggle="tab"
          href="#Discussion"
          role="tab"
          aria-controls="Discussion"
          aria-selected="false"
          ><i class="fas fa-comments"></i> <span class="d-none d-md-inline">Discussion</span></a
        >
      </li>
             <?php if (strpos($projectType, 'expense') !== false) {?>
           <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="expense"
          data-mdb-toggle="tab"
          href="#Expenses"
          role="tab"
          aria-controls="Expenses"
          aria-selected="false"
          ><i class="fas fa-credit-card"></i> <span class="d-none d-md-inline">Expense Details</span></a
        >
      </li>
        <?php } ?>
     <?php if (strpos($projectType, 'event') !== false) {?>
           <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="Event"
          data-mdb-toggle="tab"
          href="#Events"
          role="tab"
          aria-controls="Events"
          aria-selected="false"
          ><i class="fas fa-calendar-week"></i> <span class="d-none d-md-inline">Event Details</span></a
        >
      </li>
        <?php } ?>
    <?php if (strpos($projectType, 'request') !== false) {?>
           <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="Request"
          data-mdb-toggle="tab"
          href="#Requests"
          role="tab"
          aria-controls="Requests"
          aria-selected="false"
          ><i class="fas fa-shopping-cart"></i> <span class="d-none d-md-inline">Request Details</span></a
        >
      </li>
        <?php } ?>
     <?php if (strpos($projectType, 'resident') !== false) {?>
           <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="resident"
          data-mdb-toggle="tab"
          href="#residents"
          role="tab"
          aria-controls="residents"
          aria-selected="false" data-mdb-toggle="tooltip" title="Resident Info"
          ><i class="far fa-user"></i> <span class="d-none d-md-inline">Resident Information</span></a
        >
      </li>
           <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="Application"
          data-mdb-toggle="tab"
          href="#Applications"
          role="tab"
          aria-controls="Applications"
          aria-selected="false" data-mdb-toggle="tooltip" title="NJNP Application"
          ><i class="fab fa-wpforms"></i> <span class="d-none d-md-inline">NJNP Intake Form</span></a
        >
      </li>
        
           <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="incident"
          data-mdb-toggle="tab"
          href="#incidents"
          role="tab"
          aria-controls="incidents"
          aria-selected="false" data-mdb-toggle="tooltip" title="Incident Reports"
          ><i class="fas fa-exclamation-triangle"></i> <span class="d-none d-md-inline">Incident Reports</span></a
        >
      </li>
        <?php } else {?> 
      <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="Milestone"
          data-mdb-toggle="tab"
          href="#Milestones"
          role="tab"
          aria-controls="Milestones"
          aria-selected="false"
          ><i class="fas fa-signal"></i> <span class="d-none d-md-inline">Milestones</span></a
        >
      </li>
      <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="Cal"
          data-mdb-toggle="tab"
          href="#Calendar"
          role="tab"
          aria-controls="Calendar"
          aria-selected="false"
          ><i class="fas fa-calendar"></i> <span class="d-none d-md-inline">Calendar</span></a
        >
      </li>
        <?php } ?> 
    </ul>


</nav>
