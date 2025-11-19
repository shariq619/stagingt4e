<?php

namespace App\Observers;

use App\Models\ProductInvoice;
use App\Observers\Concerns\CreatesAuditLog;

class ProductInvoiceObserver
{
    use CreatesAuditLog;

    public function created(ProductInvoice $invoice): void
    {
        $this->writeAudit($invoice, 'created', null, $invoice->getAttributes());
    }

    public function updated(ProductInvoice $invoice): void
    {
        [$old, $new] = $this->changedPairs($invoice);
        if (!empty($new)) {
            $this->writeAudit($invoice, 'updated', $old, $new);
        }
    }

    public function deleted(ProductInvoice $invoice): void
    {
        $this->writeAudit($invoice, 'deleted', $invoice->getOriginal(), null);
    }

    public function restored(ProductInvoice $invoice): void
    {
        $this->writeAudit($invoice, 'restored', null, $invoice->getAttributes());
    }

    public function forceDeleted(ProductInvoice $invoice): void
    {
        $this->writeAudit($invoice, 'forceDeleted', $invoice->getOriginal(), null);
    }
}
