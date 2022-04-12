<?php

namespace Tray\Entities\Management;

use Tray\Entities\Entity;

/**
 * @property UserPermission    $Orders
 * @property UserPermission    $Customers
 * @property UserPermission    $Products
 * @property UserPermission    $Settings
 * @property UserPermission    $Payments
 * @property UserPermission    $Reports
 * @property UserPermission    $Emails
 * @property UserPermission    $Access
 * @property UserPermission    $Applications
 * @property UserPermission    $MinhaTray
 * @property UserFunctionality $Functionalities
 */
class Permission extends Entity
{
    /**
     * Sets the user's permissions for orders.
     *
     * @param  mixed $values
     * @return void
     */
    public function setOrdersAttribute($values): void
    {
        $this->attributes['Orders'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for customers.
     *
     * @param  mixed $values
     * @return void
     */
    public function setCustomersAttribute($values): void
    {
        $this->attributes['Customers'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for orders.
     *
     * @param  mixed $values
     * @return void
     */
    public function setProductsAttribute($values): void
    {
        $this->attributes['Products'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for settings.
     *
     * @param  mixed $values
     * @return void
     */
    public function setSettingsAttribute($values): void
    {
        $this->attributes['Settings'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for payments.
     *
     * @param  mixed $values
     * @return void
     */
    public function setPaymentsAttribute($values): void
    {
        $this->attributes['Payments'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for reports.
     *
     * @param  mixed $values
     * @return void
     */
    public function setReportsAttribute($values): void
    {
        $this->attributes['Reports'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for emails.
     *
     * @param  mixed $values
     * @return void
     */
    public function setEmailsAttribute($values): void
    {
        $this->attributes['Emails'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for access.
     *
     * @param  mixed $values
     * @return void
     */
    public function setAccessAttribute($values): void
    {
        $this->attributes['Access'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for applications.
     *
     * @param  mixed $values
     * @return void
     */
    public function setApplicationsAttribute($values): void
    {
        $this->attributes['Applications'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for minha tray.
     *
     * @param  mixed $values
     * @return void
     */
    public function setMinhaTrayAttribute($values): void
    {
        $this->attributes['MinhaTray'] = new UserPermission($values);
    }

    /**
     * Sets the user's permissions for functionaties.
     *
     * @param  mixed $values
     * @return void
     */
    public function setFunctionalitiesAttribute($values): void
    {
        $this->attributes['Functionalities'] = new UserFunctionality($values);
    }
}
