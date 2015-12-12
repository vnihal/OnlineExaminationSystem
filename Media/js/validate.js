
function isalphanum(ele)
{
    var r = /\W$/i;
    if (r.test(ele.value))
    {
        alert("This Field allows Only Alpha Numeric characters.");
        ele.value = "";
        ele.focus();
    }
}
function isalpha(ele)
{
    var r = /[^a-zA-Z]+/i;
    if (r.test(ele.value))
    {
        alert("This Field allows Only Alphabets.");
        ele.value = "";
        ele.focus();
    }
}
function isnum(ele)
{
    var r = /\D$/i;
    if (r.test(ele.value))
    {
        alert("This Field allows Only Numerics.");
        ele.value = "";
        ele.focus();
    }
}

function validateChangePassForm()
{

    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("repass").value;
    var ok = true;
    if (pass1 == "" || pass2 == "")
    {
        alert("Some of the fields are Empty.");
        ok = false;
        //  myform.onsubmit=false;
    }
    else if (pass1 != pass2)
    {
        alert("Passwords Do Not Match!");
        // myform.onsubmit=false;
        document.getElementById("pass1").style.borderColor = "#E34234";
        document.getElementById("pass2").style.borderColor = "#E34234";
        ok = false;

    }
    return ok;
}


function validateNewExamForm(mmyform)
{
    myform = document.forms[mmyform];

    if (myform.get == "" || myform.subdesc.value == "")
    {
        alert("Some of the fields are Empty.");
        myform.onSubmit = false;
    }
}

function fillPopUpForm(buttonObj) {
    var table = document.getElementById('mytable');
    var selectedRow = parseInt((buttonObj.value));
    selectedRow++;


    document.getElementById("popup_examName").value = table.rows[selectedRow].cells[1].innerHTML;
    if (table.rows[selectedRow].cells[2].innerHTML == "multipleChoice") {
        document.getElementById("popup_examTypeMultiple").checked = true;
        document.getElementById("popup_examTypeEssay").checked = false;
    } else {
        document.getElementById("popup_examTypeMultiple").checked = false;
        document.getElementById("popup_examTypeEssay").checked = true;
    }
    //alert("alert");
    document.getElementById("popup_secretCode").value = table.rows[selectedRow].cells[6].innerHTML;
    document.getElementById("popup_durationSpinner").value = parseInt(table.rows[selectedRow].cells[5].innerHTML);
    //document.getElementById("popup_selectedExamId").value = table.rows[selectedRow].cells[7].innerHTML;
    document.getElementById("popup_selectedExamId").value=table.rows[selectedRow].cells[7].innerHTML;

    //init date fields
    var startDate = table.rows[selectedRow].cells[3].innerHTML;
    var fromDate = new Date(startDate);
    $('#popup_from').datepicker('setDate', fromDate);

    var endDate = table.rows[selectedRow].cells[4].innerHTML;
    var toDate = new Date(endDate);
    $('#popup_to').datepicker('setDate', toDate);



}


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


