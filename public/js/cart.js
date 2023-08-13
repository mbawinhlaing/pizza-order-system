$(document).ready(function(){
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace('Kyats',''));
        $qty =Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        console.log($total);
        $parentNode.find('#total').html(`${$total} Kyats`);

        summaryCalculation();
    })
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace('Kyats',''));
        $qty =Number($parentNode.find('#qty').val());
        $total = $price*$qty;
        console.log($total);
        $parentNode.find('#total').html(`${$total} Kyats`);

        summaryCalculation();

    })


    function summaryCalculation(){
        $totalPrice =0;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace('Kyats',''));

        });
        $('#subTotalPrice').html(`${$totalPrice}Kyats `);
        $('#finalPrice').html(`${$totalPrice+5000}Kyats `);
    }
})
