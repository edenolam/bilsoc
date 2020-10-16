<?php

namespace Bilan_Social\Bundle\UserBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Bilan_Social\Bundle\UserBundle\Entity\User;

class SocialVoter extends Voter {

    const VIEW = 'view';
    const EDIT = 'edit';

    /**
     *
     * @param type $attribute
     * @param type $subject
     * @return bool
     */
    protected function supports($attribute, $subject): bool {


        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    /**
     *
     * @param type $attribute
     * @param type $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool {

        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        // Check if cdg is authorized to see form by collectivity
        if (!$subject->getCdgIsAuthorizedByCollectivity()) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($user);
            case self::EDIT:
                return $this->canEdit($user);
        }
    }

    /**
     *
     * @param User $user
     * @return boolean
     */
    private function canView(User $user): bool {


        // if they can edit, they can view
        if ($this->canEdit($user)) {
            return true;
        }

        return $user->getCanView();
    }

    /**
     *
     * @param User $user
     * @return boolean
     */
    private function canEdit(User $user): bool {

        return $user->getCanEdit();
    }

}
