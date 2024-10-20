<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
class UserController extends Controller
{

    public function postToWordPress()
    {
        echo 'fine';
        exit;
        $wpUrl = 'https://localhost/wordpress_rest_api/wp-json/wp/v2/posts';

        // Your WordPress username and Application Password
        $wpUsername = 'muhon';
        $wpAppPassword = 'KCad 09wg 5IOW YsRO pC1l I633';

        // The data you want to post
        $postData = [
            'title' => 'My Post from Laravel',
            'content' => 'This is content posted from my Laravel site.',
            'status' => 'publish'
        ];

        // Set up Guzzle client
        $client = new Client();

        try {
            // Make the POST request to WordPress REST API
            $response = $client->request('POST', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword], // Basic authentication
                'json' => $postData,                     // Data to post
                'verify' => false                        // Skip SSL verification (only for localhost)
            ]);

            // Get the response body
            $body = $response->getBody();
            return response()->json(json_decode($body, true), $response->getStatusCode());
        } catch (\Exception $e) {
            // Catch any errors and return
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    // Display a listing of users (Read)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user (Create)
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user (Update)
    public function edit($id)
    {

        $wpUrl = 'https://localhost/wordpress_rest_api/wp-json/wp/v2/posts';

        // Your WordPress username and Application Password
        $wpUsername = 'muhon';
        $wpAppPassword = 'KCad 09wg 5IOW YsRO pC1l I633';

        // The data you want to post
        $postData = [
            'title' => 'My 2nd Post from Laravel',
            'content' => 'This is content posted from my Laravel site.',
            'status' => 'publish'
        ];

        // Set up Guzzle client
        $client = new Client();

        try {
            // Make the POST request to WordPress REST API
            $response = $client->request('POST', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword], // Basic authentication
                'json' => $postData,                     // Data to post
                'verify' => false                        // Skip SSL verification (only for localhost)
            ]);

            // Get the response body
            $body = $response->getBody();
            return response()->json(json_decode($body, true), $response->getStatusCode());
        } catch (\Exception $e) {
            // Catch any errors and return
            return response()->json(['error' => $e->getMessage()]);
        }

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from the database (Delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
