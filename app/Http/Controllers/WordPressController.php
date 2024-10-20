<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WordPressController extends Controller
{
    /**
     * Fetch all posts from the WordPress REST API and display them.
     */
    public function getAllPosts()
    {
        // Retrieve the WordPress site URL and endpoint from the .env file
        $wpUrl = env('WP_SITE_URL') . '/wp-json/wp/v2/posts';
    
        // Your WordPress credentials from .env file
        $wpUsername = env('WP_API_USERNAME');
        $wpAppPassword = env('WP_API_APP_PASSWORD');
    
        // Initialize a new Guzzle client
        $client = new Client();
    
        try {
            // Send a GET request to the WordPress REST API with Basic Auth
            $response = $client->request('GET', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword],
                'verify' => false
            ]);
    
            // Parse the JSON response into an array
            $posts = json_decode($response->getBody(), true);
    
            // Pass the posts data to the Blade view
            return view('wordpress.wordpress_posts', compact('posts'));
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->back()->with('error', 'Failed to fetch posts: ' . $e->getMessage());
        }
    }

    /**
     * Fetch details of a single post by ID.
     */
    public function viewPost($id)
    {
        // Retrieve the WordPress site URL from the .env file
        $wpUrl = env('WP_SITE_URL') . "/wp-json/wp/v2/posts/{$id}";
    
        // WordPress credentials from .env
        $wpUsername = env('WP_API_USERNAME');
        $wpAppPassword = env('WP_API_APP_PASSWORD');
    
        // Initialize Guzzle client
        $client = new Client();
    
        try {
            // Send GET request to WordPress REST API for post details
            $response = $client->request('GET', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword],
                'verify' => false
            ]);
    
            // Decode the JSON response into an array
            $post = json_decode($response->getBody(), true);
    
            // Return the view with post details
            return view('wordpress.view_wordpress_post', compact('post'));
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('wordpressPosts')->with('error', 'Failed to fetch post: ' . $e->getMessage());
        }
    }

    /**
     * Post new content to WordPress via REST API.
     */
    public function postToWordPress(Request $request)
    {
        // Validate the form input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Retrieve the WordPress site URL from the .env file
        $wpUrl = env('WP_SITE_URL') . '/wp-json/wp/v2/posts';
        
        // WordPress credentials from .env
        $wpUsername = env('WP_API_USERNAME');
        $wpAppPassword = env('WP_API_APP_PASSWORD');

        // Set up post data to send to WordPress
        $postData = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => 'publish'
        ];

        // Initialize Guzzle client
        $client = new Client();

        try {
            // Send POST request to create the post
            $response = $client->request('POST', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword],
                'json' => $postData,
                'verify' => false
            ]);

            // If successful, redirect with success message
            return redirect()->route('createPostForm')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('createPostForm')->with('error', 'Failed to create post: ' . $e->getMessage());
        }
    }

    /**
     * Delete a post via REST API using the post ID.
     */
    public function deletePost($id)
    {
        // Retrieve the WordPress site URL from the .env file
        $wpUrl = env('WP_SITE_URL') . "/wp-json/wp/v2/posts/{$id}";
    
        // WordPress credentials from .env
        $wpUsername = env('WP_API_USERNAME');
        $wpAppPassword = env('WP_API_APP_PASSWORD');
    
        // Initialize Guzzle client
        $client = new Client();
    
        try {
            // Send DELETE request to remove the post
            $response = $client->request('DELETE', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword],
                'verify' => false
            ]);

            // If successful, redirect with success message
            return redirect()->route('wordpressPosts')->with('success', 'Post deleted successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('wordpressPosts')->with('error', 'Failed to delete post: ' . $e->getMessage());
        }
    }

    /**
     * Display the edit form for updating a WordPress post.
     */
    public function editPostForm($id)
    {
        // Retrieve the WordPress site URL from the .env file
        $wpUrl = env('WP_SITE_URL') . "/wp-json/wp/v2/posts/{$id}";
    
        // WordPress credentials from .env
        $wpUsername = env('WP_API_USERNAME');
        $wpAppPassword = env('WP_API_APP_PASSWORD');
    
        // Initialize Guzzle client
        $client = new Client();
    
        try {
            // Send GET request to fetch post data for editing
            $response = $client->request('GET', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword],
                'verify' => false
            ]);

            // Decode the JSON response into an array
            $post = json_decode($response->getBody(), true);

            // Return the edit form view with the post data
            return view('wordpress.edit_wordpress_post', compact('post'));
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('wordpressPosts')->with('error', 'Failed to fetch post: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing WordPress post via REST API.
     */
    public function updatePost(Request $request, $id)
    {
        // Validate the form input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Retrieve the WordPress site URL from the .env file
        $wpUrl = env('WP_SITE_URL') . "/wp-json/wp/v2/posts/{$id}";
    
        // WordPress credentials from .env
        $wpUsername = env('WP_API_USERNAME');
        $wpAppPassword = env('WP_API_APP_PASSWORD');
    
        // Set up the data for the post update
        $postData = [
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ];

        // Initialize Guzzle client
        $client = new Client();
    
        try {
            // Send POST request to update the post
            $response = $client->request('POST', $wpUrl, [
                'auth' => [$wpUsername, $wpAppPassword],
                'json' => $postData,
                'verify' => false
            ]);

            // If successful, redirect with success message
            return redirect()->route('wordpressPosts')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('wordpressPosts')->with('error', 'Failed to update post: ' . $e->getMessage());
        }
    }
}
