public function rules(): array
{
    return [
        'user_id' => 'required|exists:users,id|unique:enseignants,user_id',
        'specialite' => 'nullable|string|max:255',
        'biographie' => 'nullable|string',
        'diplome' => 'nullable|string',
        'annees_experience' => 'nullable|integer|min:0',
        'competences' => 'nullable|json', // Changé de 'array' à 'json'
        'reseaux_sociaux' => 'nullable|json', // Changé de 'array' à 'json'
        'photo' => 'nullable|image|max:2048',
        'is_active' => 'nullable|boolean'
    ];
}