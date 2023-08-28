<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Contacts extends Component
{
    public  $name;
    public  $tel;
    public $editing = false;
    public $contacts;
    public $photo;
    public $contactId;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    //validation rules
    protected $rules = [
        'name' => 'required|min:6',
        'tel' => 'required|min:10',
        'photo' => 'image|max:1024'
    ];
    //custome message
    protected $messages = [
        'name.required' => 'le champ nom est obligatoire.',
        'name.min' => 'le champ doit étres 6 caractére au min.',
        'tel.required' => 'le champ tel est obligatoire.',
        'tel.min' => 'le champ doit étres 6 caractére au min.',
    ];
    //exucute in loading page
    public function mount()
    {
        if(!auth()->check()){
  return redirect("/auth");
        }
        $this->getContacts();
    }
    public function getContacts()
    {
        $contacts = Contact::all();
        $this->contacts = $contacts;
    }
    public function getContact($id)
    {
        $contact = Contact::find($id);
        $this->contactId = $contact->id;
        $this->name = $contact->name;
        $this->tel = $contact->tel;
        $this->editing = true;
    }

    function addContact()
    {
        $this->validate();
        $newContact = new Contact();
        $newContact->name = $this->name;
        $newContact->tel = $this->tel;
        $newContact->photo = $this->saveImage();
        $newContact->save();
        //refresh page automaticly
        $this->contacts->prepend($newContact);
        $this->name = "";
        $this->tel = "";
        $this->photo = "";
        session()->flash('message', 'contact successfully added.');
    }
    public function render()
    {
        return view('livewire.contacts')->with([
            "contactsList" => Contact::latest()->paginate(5)
        ]);
    }
    // updating contact
    public function cancel(){
        $this->contactId="";
        $this->name="";
        $this->tel="";
        $this->photo = "";
        $this->editing=false;

    }
    public function updateContact(){
        $this->validate(['name' => 'required|min:6',
            'tel' => 'required|min:10',

        ]);
        $newContact = Contact::find($this->contactId);
        $newContact->name = $this->name;
        $newContact->tel = $this->tel;
        if($newContact->photo) {
 $this->validate([
                'photo' => 'image|max:1024'
        ]);
        if (File::exists(public_path("./storage/photos/" . $newContact->photo))) {
            File::delete(public_path("./storage/photos/" . $newContact->photo));
        }
            $newContact->photo = $this->saveImage();
        }
        $newContact->update();
        //refresh page automaticly
        $this->getContacts();
        $this->name = "";
        $this->tel = "";
        $this->photo = "";
        $this->contactId = "";
        $this->editing = false;
        session()->flash('message', 'contact successfully updated.');
    }
    public function deleteContact($contactId)  {
   $contact=Contact::find($contactId);
   if (File::exists(public_path("./storage/photos/".$contact->photo))) {
   File::delete(public_path("./storage/photos/".$contact->photo));
   }
   $contact->delete();
   //delet contact in list with not refresh page
   $this->contacts=$this->contacts->except($contactId);
        session()->flash('message', 'contact successfully deleted.');

    }
   private  function saveImage()  {
        $this->photo->storeAs('photos', $this->photo->getClientOriginalName(),'public');
        return $this->photo->getClientOriginalName();

    }
}
