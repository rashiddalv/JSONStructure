<?php
class JSONDatabase {
    private $file;
    private $data;

    public function __construct($filename) {
        $this->file = $filename;
        $this->loadData();
    }

    private function loadData(): void
    {
        if (!file_exists($this->file)) {
            file_put_contents($this->file, '[]');
        }
        $this->data = json_decode(file_get_contents($this->file), true);
    }

    private function saveData(): void
    {
        file_put_contents($this->file, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function getAll() {
        return $this->data;
    }

    public function insert($record) {
        $record['id'] = uniqid();
        $this->data[] = $record;
        $this->saveData();
        return $record;
    }

    public function delete($id): void
    {
        $this->data = array_filter($this->data, function($item) use ($id) {
            return $item['id'] !== $id;
        });
        $this->saveData();
    }
}

$db = new JSONDatabase('/data/users.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $db->delete($_POST['delete']);
    } else {
        $newUser = [
            'name' => htmlspecialchars($_POST['name']),
            'email' => htmlspecialchars($_POST['email']),
            'age' => htmlspecialchars($_POST['age']),
            'created' => date('Y-m-d H:i:s')
        ];
        $db->insert($newUser);
    }
}

$users = $db->getAll();
