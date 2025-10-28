<?php

class Auth {
    private static $MOCK_USERS = [
        [
            'id' => '1',
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => 'password123'
        ]
    ];

    public static function login($email, $password) {
        $user = null;
        foreach (self::$MOCK_USERS as $mockUser) {
            if ($mockUser['email'] === $email) {
                $user = $mockUser;
                break;
            }
        }

        if (!$user) {
            throw new Exception('Invalid credentials');
        }

        if ($user['password'] !== $password) {
            throw new Exception('Invalid credentials');
        }

        $session = [
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ],
            'token' => 'mock-token-' . time()
        ];

        return $session;
    }

    public static function signup($name, $email, $password) {
        if (strlen($password) < 8) {
            throw new Exception('Password must be at least 8 characters');
        }

        foreach (self::$MOCK_USERS as $user) {
            if ($user['email'] === $email) {
                throw new Exception('User already exists');
            }
        }

        $newUser = [
            'id' => (count(self::$MOCK_USERS) + 1) . '',
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        self::$MOCK_USERS[] = $newUser;

        $session = [
            'user' => [
                'id' => $newUser['id'],
                'name' => $newUser['name'],
                'email' => $newUser['email']
            ],
            'token' => 'mock-token-' . time()
        ];

        return $session;
    }

    public static function verify($token) {
        return strpos($token, 'mock-token-') === 0;
    }

    public static function logout() {
        session_start();
        session_destroy();
        
        return [
            'success' => true,
            'redirect' => '/auth/login'
        ];
    }
}
