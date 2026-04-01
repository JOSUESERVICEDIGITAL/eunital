<?php

namespace App\Services\Juridique;

use App\Models\Juridique\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DocumentGenerationService
{
    public function generatePDF(Document $document, array $options = [])
    {
        $data = $this->prepareData($document);

        $pdf = Pdf::loadView('back.juridique.pdf.' . $document->typeDocument->categorie, $data);

        // Configuration par défaut
        $pdf->setPaper($options['paper'] ?? 'A4', $options['orientation'] ?? 'portrait');
        $pdf->setOption('defaultFont', $options['font'] ?? 'DejaVu Sans');

        if ($options['watermark'] ?? false) {
            $pdf->setOption('watermark', $options['watermark_text'] ?? 'CONFIDENTIEL');
        }

        $filename = "documents/{$document->numero_unique}.pdf";
        $path = Storage::disk('public')->path($filename);

        $pdf->save($path);

        $document->update(['fichier_path' => $filename]);

        return $pdf;
    }

    public function generateBatch(array $documents, array $options = [])
    {
        $pdfs = [];

        foreach ($documents as $document) {
            $pdfs[] = $this->generatePDF($document, $options);
        }

        return $pdfs;
    }

    private function prepareData(Document $document)
    {
        return [
            'document' => $document,
            'type' => $document->typeDocument,
            'contrat' => $document->contrat,
            'engagement' => $document->engagement,
            'signatures' => $document->signatures,
            'entreprise' => $document->entreprises->first(),
            'utilisateurs' => $document->utilisateurs,
            'date_generation' => now(),
            'logo' => public_path('images/logo.png')
        ];
    }
}
