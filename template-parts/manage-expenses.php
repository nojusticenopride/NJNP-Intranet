
<style>
        .table-editor.sm td, .table-editor.sm th {
    padding: .35rem .64rem;
}
  select#acf-field_5ffc72eea3d81-field_5ffc72eea3d81_field_obfaozyisol91u {
    height: 50px;
  }

  .acf-field.acf-field-select.acf-field-obfaozyisol91u.is-required.-r0 {
    min-height: auto !important;
    padding-top: 0;
    padding-bottom: 0;
  }

  .acf-field.acf-field-image.acf-field-ks9zhijinbn8vr.is-required.-r0 {
    min-height: auto !important;

    padding-top: 0;
    padding-bottom: 0;
  }

  input.acf-button.button.button-primary.button-large {
    width: 56%;
    text-align: center;
    margin: 18px auto 0!important;
  }

  @media only screen and (min-width: 992px) {
    div#panel { 
      margin:0 auto;
      width:75%;
    }
  }
</style>
<?php  $currentuser_ID = get_current_user_id(); ?>


    <div class="row">
      <div class="columns">
             <h2 class="entry-title mb-3"> Manage Expenses</h2>
<div class="container">
  
    <div class="d-flex justify-content-between mb-4">
  <button id="async_data_btn" class="btn btn-primary btn-sm">
    Load data
  </button>
  <div class="d-flex">
    <div class="form-outline">
      <input
        type="text"
        data-mdb-search
        data-mdb-target="#table_async_data"
        id="search_async"
        class="form-control"
      />
      <label class="form-label" for="search_async">Search</label>
    </div>
    <button
      class="btn btn-primary btn-sm ms-3"
      data-mdb-add-entry
      data-mdb-target="#table_async_data"
    >
      <i class="fa fa-plus"></i>
    </button>
  </div>
</div>
<hr />
<div id="table_async_data"></div>
   <script src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.4.0/js/mdb.min.js"></script>
<script src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Pro-Advanced_3.4.0/plugins/js/all.min.js"></script>
          </div>
          
          
         
        </div>
      </div>
  
    <script defer>
const table = document.getElementById('table_async_data');
const loadBtn = document.getElementById('async_data_btn');

    
const columns = [
  { label: 'ID', field: 'id', editable: false, width: 60},
  { label: 'Details', field: 'link', editable: false, width:200},
  { label: 'Status', field: 'expense_status',    defaultValue: 'Pending',
    options: ['In progress','Approved','Pending','Paid','Check Notes','Decline'],
    inputType: 'select',  width: 100},
  { label: 'Category', field: 'category',    defaultValue: 'Travel : Payroll - Travel',
    options: [
'Insurance : Payroll - Insurance',
'Taxes : Administration - Taxes',
'Bank Fees : Administration - Bank Fees',
'Rent : Administration - Rent',
'Groceries - meal program : Administration - Groceries - meal program',
'Other Fees and services : Administration - Other Fees and services',
'Misc. : Administration - Misc.',
'Electric : Utilities - Electric',
'Gas : Utilities - Gas',
'Internet : Utilities - Internet',
'Water : Utilities - Water',
'Payroll taxes : Payroll - Payroll taxes',
'Salaries : Payroll - Salaries',
'Telephone : Payroll - Telephone',
'Travel : Payroll - Travel',
'Consultants : Professional Fees - Consultants',
'Honoraria : Professional Fees - Honoraria',
'Legal : Professional Fees - Legal',
'Accounting : Professional Fees - Accounting',
'Electronics : Equipment (Rental, Maintenance, Purchase) - Electronics',
'Misc : Equipment (Rental, Maintenance, Purchase) - Misc',
'Art Materials : Supplies (art supplies for example) - Art Materials',
'Building : Supplies (art supplies for example) - Building',
'Event/Action Materials : Supplies (art supplies for example) - Event/Action Materials',
'Postage & Shipping : Supplies (art supplies for example) - Postage & Shipping',
'Printing & Photocopying : Supplies (art supplies for example) - Printing & Photocopying',
'Covid Relief : Regrants - Covid Relief',
'Emergency Funds : Regrants - Emergency Funds',
'## Suscriptions & Services',
'Digital -  Communications & social media : Suscriptions & Services - Digital -  Communications & social media',
'Marketing & Advertising : Suscriptions & Services - Marketing & Advertising',
'Meeting : Suscriptions & Services - Meeting',
'Operations : Suscriptions & Services - Operations',
'Research : Suscriptions & Services - Research',
'Wellness / Staff Enrichment : Suscriptions & Services - Wellness / Staff Enrichment',
'Events : Travel - Events',
'Per Diem : Travel - Per Diem',
'Gifts : Income - Gifts',
'Grants : Income - Grants',
'Misc. Income : Income - Misc. Income',
'Royalty Income : Income - Royalty Income',
'Resource Transfer : Income - Resource Transfer',
'Roll-Over : Income - Roll-Over'],
    inputType: 'select', width: 150 },
  { label: 'Receipt', field: 'receipts', editable: false, width:60 },
  { label: 'Amount', field: 'amount', width: 60},
  { label: 'vendor', field: 'vendor', width: 60 },
  { label: 'Receipt Date', field: 'receipt_date', width:100},
  { label: 'Notes', field: 'notes', width:100} ,
  { label: 'Approved by', field: 'approver_name', width:80}
];

const asyncTable = new TableEditor(
  table,
  {
    columns,
  },
  {
    loading: true, entries: 10, entriesOptions: [5, 10, 15],fixedHeader: true,sm: true,actionPosition:'start' }
);

const loadData = () => {
  asyncTable.update(null, { loading: true });

  fetch('https://njnpcommunity.org/wp-json/njnp-json/v1/expenses')
    .then((response) => response.json())
    .then((data) => {
      asyncTable.update(
        {
          rows: data.map((user) => ({
            ...user,
          })),
        },
        { loading: false }
      );
    });
};


loadBtn.addEventListener('click', loadData);

table.addEventListener('updateEntry.mdb.tableEditor', (e) => {
 
  const { id, expense_status, category, amount, receipt_date,notes, approver_name } = e.row;
  console.log(id +' - ${expense_status} - ${category} - ${amount} - ${receipt_date} - ${approver_name}');
    
      (function($) {
    var data = {
          action: 'my_ajax_expense',
        expenseID:id,
        expense_status:expense_status,
        category:category,
        amount:amount,
        notes:notes,
        approver_name:approver_name,
        receipt_date:receipt_date
      };
    
      $.ajax({
                        url: ajaxexpense.ajaxurl, 
                        data: data, 
                            type: "POST",
                            dataType: "html",
                            success: function (textStatus) {
                                $(this).html('Expense  updated');
                                console.log('Expense  updated');
               $('.expense-card-footer').addClass('d-none');
                            },
                        error: function(MLHttpRequest, textStatus, errorThrown){  alert(errorThrown);  }  
                    });
    })( jQuery );
            
});


function eventFire(el, etype){
  if (el.fireEvent) {
    el.fireEvent('on' + etype);
  } else {
    var evObj = document.createEvent('Events');
    evObj.initEvent(etype, true, false);
    el.dispatchEvent(evObj);
  }
}

eventFire(document.getElementById('async_data_btn'), 'click');
    
</script>