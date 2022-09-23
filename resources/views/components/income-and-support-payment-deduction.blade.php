<script>
    'use strict'
    let type = document.getElementById('type');

    window.addEventListener('DOMContentLoaded', function(){
      deducted_income();
      deducted_support_payment();
    });

    type.addEventListener('change', function(){
      deducted_income();
    });

    function deducted_income(){
      let income = document.getElementById('income').value;
      if(type.value == 1 || type.value == 2){
        let deducted_income = income - 100000;
        if(deducted_income < 0){
          deducted_income = 0
        }
        document.getElementById('deducted_income').innerHTML = deducted_income.toLocaleString();
      } else if(type.value == 5) {
        let deducted_income = income - 200000;
        if(deducted_income < 0){
          deducted_income = 0
        }
        document.getElementById('deducted_income').innerHTML = deducted_income.toLocaleString();
      } else {
        let deducted_income = Number(income);
        document.getElementById('deducted_income').innerHTML = deducted_income.toLocaleString();
      }
    }

    function deducted_support_payment(){
      let support_payment = document.getElementById('support_payment').value;
      let deducted_support_payment = support_payment * 0.8;
      document.getElementById('deducted_support_payment').innerHTML = deducted_support_payment.toLocaleString();
    }
</script>
