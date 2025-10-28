<?php

namespace App;

class DashboardController {
    private $twig;
    private $authService;
    private $ticketService;

    public function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => __DIR__ . '/../cache',
            'auto_reload' => true
        ]);
        $this->authService = new AuthService();
        $this->ticketService = new TicketService();
        
        $this->authService->requireAuth();
    }

    public function index() {
        $tickets = $this->ticketService->listTickets();
        $total = count($tickets);
        $open = 0;
        $resolved = 0;

        foreach ($tickets as $ticket) {
            if ($ticket['status'] === 'open') {
                $open++;
            } elseif ($ticket['status'] === 'closed') {
                $resolved++;
            }
        }

        $stats = [
            'total' => $total,
            'open' => $open,
            'resolved' => $resolved
        ];

        echo $this->twig->render('dashboard.twig', [
            'stats' => $stats,
            'isAuth' => true,
            'message' => null,
            'msgType' => null
        ]);
    }
}

