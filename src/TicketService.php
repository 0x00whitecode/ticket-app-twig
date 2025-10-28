<?php

namespace App;

class TicketService {
    private const TICKETS_FILE = __DIR__ . '/../data/tickets.json';

    private function readTickets() {
        if (!file_exists(self::TICKETS_FILE)) {
            return [];
        }
        $content = file_get_contents(self::TICKETS_FILE);
        return json_decode($content, true) ?: [];
    }

    private function writeTickets($tickets) {
        $dir = dirname(self::TICKETS_FILE);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents(self::TICKETS_FILE, json_encode($tickets, JSON_PRETTY_PRINT));
    }

    private function generateId() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public function listTickets() {
        return $this->readTickets();
    }

    public function createTicket($title, $status, $description = '', $priority = 'low') {
        if (empty($title)) {
            throw new \Exception('Title is required');
        }
        if (!in_array($status, ['open', 'in_progress', 'closed'])) {
            throw new \Exception('Invalid status');
        }
        if (!in_array($priority, ['low', 'medium', 'high'])) {
            throw new \Exception('Invalid priority');
        }

        $tickets = $this->readTickets();
        $ticket = [
            'id' => $this->generateId(),
            'title' => $title,
            'status' => $status,
            'description' => $description,
            'priority' => $priority,
            'created_at' => time()
        ];

        array_unshift($tickets, $ticket);
        $this->writeTickets($tickets);

        return $ticket;
    }

    public function updateTicket($id, $title, $status, $description = '', $priority = 'low') {
        $tickets = $this->readTickets();
        
        foreach ($tickets as &$ticket) {
            if ($ticket['id'] === $id) {
                if (empty($title)) {
                    throw new \Exception('Title is required');
                }
                if (!in_array($status, ['open', 'in_progress', 'closed'])) {
                    throw new \Exception('Invalid status');
                }

                $ticket['title'] = $title;
                $ticket['status'] = $status;
                $ticket['description'] = $description;
                $ticket['priority'] = $priority;

                $this->writeTickets($tickets);
                return $ticket;
            }
        }

        throw new \Exception('Ticket not found');
    }

    public function deleteTicket($id) {
        $tickets = $this->readTickets();
        $newList = [];

        foreach ($tickets as $ticket) {
            if ($ticket['id'] !== $id) {
                $newList[] = $ticket;
            }
        }

        $this->writeTickets($newList);
        return true;
    }
}

