'use strict'
let type = document.getElementById('type');

window.addEventListener('DOMContentLoaded', function(){
  deducted_income();
  deducted_support_payment();
});

type.addEventListener('change', function(){
  let income = document.getElementById('income').value;
  if(type.value == 1 || type.value == 2){
    let deducted_income = income - 100000;
    document.getElementById('deducted_income').innerHTML = deducted_income;
  } else {
    let deducted_income = income;
    document.getElementById('deducted_income').innerHTML = deducted_income;
  }
});

function deducted_income(){
let income = document.getElementById('income').value;
if(type.value == 1 || type.value == 2){
  let deducted_income = income - 100000;
  document.getElementById('deducted_income').innerHTML = deducted_income;
}
}

function deducted_support_payment(){
let support_payment = document.getElementById('support_payment').value;
let deducted_support_payment = support_payment * 0.8;
document.getElementById('deducted_support_payment').innerHTML = deducted_support_payment;
}
