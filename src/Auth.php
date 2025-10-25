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
        // Find user
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

        // Validate password
        if ($user['password'] !== $password) {
            throw new Exception('Invalid credentials');
        }

        // Create session with public user data (excluding password)
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
        // Validate password
        if (strlen($password) < 8) {
            throw new Exception('Password must be at least 8 characters');
        }

        // Check if user exists
        foreach (self::$MOCK_USERS as $user) {
            if ($user['email'] === $email) {
                throw new Exception('User already exists');
            }
        }

        // Create new user
        $newUser = [
            'id' => (count(self::$MOCK_USERS) + 1) . '',
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];

        // Add to mock database (memory only)
        self::$MOCK_USERS[] = $newUser;

        // Create session
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
        // Nothing to do server-side for localStorage-based auth
        return true;
    }
}
