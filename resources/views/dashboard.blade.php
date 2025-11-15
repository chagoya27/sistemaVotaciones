<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @can('ver graficas')
        <div id="chart">
        </div>
    @endcan
    <script>

        //se utiliza apex chart para generar las graficas
        //chart: propiedades del grafico, aqui decimos que sea de pastel con 'pie'
        //series y labels son los datos y etiquetas de la grafica se pasan en formato JSON

        //grafica 1 
         var options = {
            chart: {
                    type: 'pie', 
                    height: '300px'
            },
            series: @json($series1),
            labels: @json($labels1),
            colors: ['#1E90FF', '#FF6347', '#FFD700', '#32CD32', '#FF69B4'],
            legend: {
                    position: 'bottom'
            },
                title: {
                    text: '¿Estás de acuerdo con realizar un paro estudiantil como forma de protesta ante las condiciones actuales?',
                    align: 'center'
                }
            };


        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();



        // grafica 2
        var options = {
            chart: {
                    type: 'pie',
                    height: '300px'
            },
            series: @json($series2),
            labels: @json($labels2),
            colors: ['#1E90FF', '#FF6347', '#FFD700', '#32CD32', '#FF69B4'],
            legend: {
                    position: 'bottom'
            },
                title: {
                    text: 'En caso de realizarse el paro, ¿qué alternativa consideras mejor',
                    align: 'center'
                }
            };


        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();


        //grafica 3
        var options = {
            chart: {
                    type: 'pie',
                    height: '300px'
            },
            series: @json($series3),
            labels: @json($labels3),
            colors: ['#1E90FF', '#FF6347', '#FFD700', '#32CD32', '#FF69B4'],
            legend: {
                    position: 'bottom'
            },
                title: {
                    text: '¿Cuánto tiempo consideras adecuado para un paro?',
                    align: 'center'
                }
            };


        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();

        
    </script>
</x-app-layout>
