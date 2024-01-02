$(document).ready(function () {
    let e = document.getElementById("salesPurchasesChart");
    let myChart;

    function updateChart(month, year) {
        if (myChart) {
            myChart.destroy();
        }

        $.get(`/sales-purchases/chart-data/${month}/${year}`, function (a) {
            console.log(a)
            myChart = new Chart(e, {
                type: "bar",
                data: {
                    labels: a.sales.original.days,
                    datasets: [{
                        label: "Penjualan",
                        data: a.sales.original.data,
                        backgroundColor: ["#6366F1"],
                        borderColor: ["#6366F1"],
                        borderWidth: 1
                    }, {
                        label: "Pembelian",
                        data: a.purchases.original.data,
                        backgroundColor: ["#A5B4FC"],
                        borderColor: ["#A5B4FC"],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    }

    // Initial chart rendering
    updateChart($("#month").val(), $("#year").val());

    // Update chart on select change
    $("#month, #year").on("change", function () {
        updateChart($("#month").val(), $("#year").val());
    });



    let t = document.getElementById("currentMonthChart");
    $.get("/current-month/chart-data", function(a){
        new Chart(t, {
            type: "doughnut",
            data: {
                labels: ["Penjualan", "Pembelian", "Pengeluaran"],
                datasets: [{
                    data: [a.sales, a.purchases, a.expenses],
                    backgroundColor: ["#F59E0B", "#0284C7", "#EF4444"],
                    hoverBackgroundColor: ["#F59E0B", "#0284C7", "#EF4444"]
                }]
            }
        })
    });

    let r = document.getElementById("paymentChart");
    $.get("/payment-flow/chart-data", function(a){
        new Chart(r, {
            type: "line",
            data: {
                labels: a.months,
                datasets: [{
                    label: "Pembayaran Dikirim",
                    data: a.payment_sent,
                    fill: false,
                    borderColor: "#EA580C",
                    tension: 0
                },{
                    label: "Pembayaran Diterima",
                    data: a.payment_received,
                    fill: false,
                    borderColor: "#2563EB",
                    tension: 0
                }]
            }
        })
    })
});
