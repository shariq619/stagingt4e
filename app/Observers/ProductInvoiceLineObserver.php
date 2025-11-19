<?php

namespace App\Observers;

use App\Models\ProductInvoiceLine;
use App\Observers\Concerns\CreatesAuditLog;

class ProductInvoiceLineObserver
{
    use CreatesAuditLog;

    public function created(ProductInvoiceLine $line): void
    {
        $this->writeAudit($line, 'created', null, $line->getAttributes());
    }

    public function updated(ProductInvoiceLine $line): void
    {
        [$old, $new] = $this->changedPairs($line);
        if (!empty($new)) {
            $this->writeAudit($line, 'updated', $old, $new);
        }
    }

    public function deleted(ProductInvoiceLine $line): void
    {
        $this->writeAudit($line, 'deleted', $line->getOriginal(), null);
    }

    public function restored(ProductInvoiceLine $line): void
    {
        $this->writeAudit($line, 'restored', null, $line->getAttributes());
    }

    public function forceDeleted(ProductInvoiceLine $line): void
    {
        $this->writeAudit($line, 'forceDeleted', $line->getOriginal(), null);
    }
}
