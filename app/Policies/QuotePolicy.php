<?php

namespace App\Policies;

use App\User;
use App\Quote;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the quote.
     *
     * @param  \App\User  $user
     * @param  \App\Quote  $quote
     * @return mixed
     */
    public function view(User $user, Quote $quote)
    {
        //
        return $user->id = $quote->user_id || $user->permission >= 3;
    }

    /**
     * Determine whether the user can create quotes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->permission >= 2;
    }

    /**
     * Determine whether the user can update the quote.
     *
     * @param  \App\User  $user
     * @param  \App\Quote  $quote
     * @return mixed
     */
    public function update(User $user, Quote $quote)
    {
        //
        return $user->id = $quote->user_id || $user->permission >= 3;
    }

    /**
     * Determine whether the user can delete the quote.
     *
     * @param  \App\User  $user
     * @param  \App\Quote  $quote
     * @return mixed
     */
    public function delete(User $user, Quote $quote)
    {
        //
        return $user->id = $quote->user_id || $user->permission >= 3;
    }
}
