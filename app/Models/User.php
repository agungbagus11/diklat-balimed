public function registrations()
{
    return $this->hasMany(\App\Models\Registration::class);
}