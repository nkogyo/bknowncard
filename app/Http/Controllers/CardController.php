<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::where('user_id', auth()->id())->get();
        return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'background_color' => 'nullable',
            'background_opacity' => 'nullable|numeric|min:0|max:100',
            'background_zoom' => 'nullable|numeric|min:50|max:200',
            'background_image' => 'nullable|image|max:2048', // Max 2MB
            'text_color' => 'nullable',
            'unique_id' => 'nullable',
        ]);
        
        // Handle image upload if provided
        $backgroundImagePath = null;
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->file('background_image')->store('card-backgrounds', 'public');
        }
        
        // Generate unique ID if not provided
        $uniqueId = $request->unique_id ?? Str::uuid();
        
        // Create the card with all the data
        $card = Card::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'title' => $request->title,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'background_color' => $request->background_color ?? '000000',
            'background_image' => $backgroundImagePath,
            'background_opacity' => $request->background_opacity ?? 100,
            'background_zoom' => $request->background_zoom ?? 100,
            'text_color' => $request->text_color ?? 'ffffff',
            'unique_id' => $uniqueId,
            'share_url' => url('/cards/public/' . $uniqueId),
        ]);
        
        return redirect()->route('cards.show', $card)->with('success', 'Card created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $card = Card::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        return view('cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $card = Card::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        return view('cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'background_color' => 'nullable',
            'background_opacity' => 'nullable|numeric|min:0|max:100',
            'background_zoom' => 'nullable|numeric|min:50|max:200',
            'background_image' => 'nullable|image|max:2048',
            'text_color' => 'nullable',
        ]);

        $card = Card::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        // Handle image upload if provided
        if ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($card->background_image && file_exists(public_path('storage/' . $card->background_image))) {
                unlink(public_path('storage/' . $card->background_image));
            }
            
            $backgroundImagePath = $request->file('background_image')->store('card-backgrounds', 'public');
            $card->background_image = $backgroundImagePath;
        }
        
        $card->name = $request->name;
        $card->title = $request->title;
        $card->address = $request->address;
        $card->phone = $request->phone;
        $card->email = $request->email;
        
        // Update styling properties if provided
        if ($request->has('background_color')) {
            $card->background_color = $request->background_color;
        }
        
        if ($request->has('text_color')) {
            $card->text_color = $request->text_color;
        }
        
        if ($request->has('background_opacity')) {
            $card->background_opacity = $request->background_opacity;
        }
        
        if ($request->has('background_zoom')) {
            $card->background_zoom = $request->background_zoom;
        }
        
        $card->save();
        
        return redirect()->route('cards.show', $card->id)->with('success', 'Card updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $card = Card::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        // Delete background image if exists
        if ($card->background_image && file_exists(public_path('storage/' . $card->background_image))) {
            unlink(public_path('storage/' . $card->background_image));
        }
        
        $card->delete();
        
        return redirect()->route('cards.index')->with('success', 'Card deleted successfully!');
    }

    /**
     * Display the public view of a card.
     */
    public function publicShow($uniqueId)
    {
        $card = Card::where('unique_id', $uniqueId)->firstOrFail();
        return view('cards.public', compact('card'));
    }
}