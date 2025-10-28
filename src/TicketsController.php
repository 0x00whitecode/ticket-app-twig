<?php

namespace App;

class TicketsController {
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
        $message = null;
        $msgType = null;
        
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            $msgType = $_GET['type'] ?? 'info';
        }

        $tickets = $this->ticketService->listTickets();

        echo $this->twig->render('tickets.twig', [
            'tickets' => $tickets,
            'message' => $message,
            'msgType' => $msgType,
            'isAuth' => true
        ]);
    }

    public function createAction() {
        $title = $_POST['title'] ?? '';
        $status = $_POST['status'] ?? 'open';
        $description = $_POST['description'] ?? '';
        $priority = $_POST['priority'] ?? 'low';

        try {
            $this->ticketService->createTicket($title, $status, $description, $priority);
            header('Location: /tickets?message=Ticket created&type=success');
        } catch (\Exception $e) {
            header('Location: /tickets?message=' . urlencode($e->getMessage()) . '&type=error');
        }
        exit;
    }

    public function editAction() {
        $id = $_POST['id'] ?? '';
        $title = $_POST['title'] ?? '';
        $status = $_POST['status'] ?? 'open';
        $description = $_POST['description'] ?? '';
        $priority = $_POST['priority'] ?? 'low';

        try {
            $this->ticketService->updateTicket($id, $title, $status, $description, $priority);
            header('Location: /tickets?message=Ticket updated&type=success');
        } catch (\Exception $e) {
            header('Location: /tickets?message=' . urlencode($e->getMessage()) . '&type=error');
        }
        exit;
    }

    public function deleteAction() {
        $id = $_GET['id'] ?? '';

        try {
            $this->ticketService->deleteTicket($id);
            header('Location: /tickets?message=Ticket deleted&type=success');
        } catch (\Exception $e) {
            header('Location: /tickets?message=' . urlencode($e->getMessage()) . '&type=error');
        }
        exit;
    }
}

