const table = document.getElementById('table_async_data');
const loadBtn = document.getElementById('async_data_btn');
const groupTab = document.body.querySelector('a[data-section="expenses"]');

    
const columns = [
  { label: 'ID', field: 'id', editable: false, width: 90},
  { label: 'Quick Approve', field: 'button', editable: false, width:75 },
  { label: 'Details', field: 'link', editable: false, width:160},
  { label: 'Status', field: 'expense_status',    defaultValue: 'Pending',
    options: ['In progress','Approved','Pending','Paid','Check Notes','Decline'],
    inputType: 'select',  width: 80},
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
  { label: 'Amount', field: 'amount', width: 90},
  { label: 'vendor', field: 'vendor', width: 120 },
  { label: 'Receipt Date', field: 'receipt_date'},
  { label: 'Notes', field: 'notes' },
  { label: 'Approved by', field: 'approver_name' }
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

groupTab.addEventListener('click', loadData);
table.addEventListener('updateEntry.mdb.tableEditor', (e) => {
 
  const { id, expense_status, category, amount, receipt_date, approver_name } = e.row;
  console.log(id +' - ${expense_status} - ${category} - ${amount} - ${receipt_date} - ${approver_name}');
    
      (function($) {
    var data = {
          action: 'my_ajax_expense',
        expenseID:id,
        expense_status:expense_status,
        category:category,
        amount:amount,
        notes:notes,
        receipt_date:receipt_date
      };
    
      $.ajax({
                        url: ajaxexpense.ajaxurl, 
                        data: data, 
                            type: "POST",
                            dataType: "html",
                            success: function (textStatus) {
                                $(this).html('Expense set to paid');
                                console.log('Expense set to paid');
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

    