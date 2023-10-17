
function printDiv(imprime) {
    var printContents = document.getElementById(imprime).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
