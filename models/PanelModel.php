<?php
class PanelModel
{
    public function getStats(): array
    {
        return [
            ['title' => 'Camiones Registrados', 'value' => '70', 'icon' => 'mdi-truck', 'color' => 'primary'],
            ['title' => 'Espacios Disponibles', 'value' => '20', 'icon' => 'mdi-package-variant', 'color' => 'success'],
            ['title' => 'Pagos Pendientes', 'value' => '8', 'icon' => 'mdi-cash-multiple', 'color' => 'warning'],
            ['title' => 'Pagos al Corriente', 'value' => '10', 'icon' => 'mdi-check-circle', 'color' => 'info'],
        ];
    }

    public function getActivity(): array
    {
        return [
            ['fecha' => '13/03/2026', 'linea' => 'GRL', 'operador' => 'Enrique Guzmán', 'pensionado' => 'Boleto'],
            ['fecha' => '12/03/2026', 'linea' => 'PETROPIPAS', 'operador' => 'Luis Roldán', 'pensionado' => 'Boleto'],
            ['fecha' => '11/03/2026', 'linea' => 'COSTA A COSTA', 'operador' => 'Julio Rodríguez', 'pensionado' => 'Boleto'],
            ['fecha' => '10/03/2026', 'linea' => 'SANTEX', 'operador' => 'Rodrigo Velázquez', 'pensionado' => 'SI'],
        ];
    }
}
