<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,td{
        padding: 5px 5px 5px 5px;
    }

   th, td {
        border: 1px solid black;
    }

    .company-title {
        font-size: 20px;
        font-weight: bold;
    }

    .company-address{
        font-size: 12px;
    }

    .body-top,.body-head-content,.customer-head-content,.body-amount-details{
        padding-top: 10px;
    }
    .product-category-content-list{
        padding-top: 27px;
    }
    .product-category-content-list table th{
        background: #3c3c3c;
        color: white;
        text-align: center;
    }
    .report-title{
        font-family: "Times New Roman", Times, serif;
        text-align: center;
        font-size: 24px;
    }

    .invoice-footer-details{
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .authbytext{
        bottom: 0;
    }


    @media print {
        @page {
            margin: 0.7cm;
        }
        .product-category-content-list table th{
            background: #3c3c3c;
            color: white;
            text-align: center;
        }
    }
</style>
