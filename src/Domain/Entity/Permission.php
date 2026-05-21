<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\PermissionEffect;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(
    name: 'permissions',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_permissions_role_action', columns: ['role_identifier', 'action_list_identifier']),
    ],
)]
class Permission extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'permissions')]
    #[ORM\JoinColumn(name: 'role_identifier', referencedColumnName: 'identifier', nullable: false)]
    private Role $role;

    #[ORM\ManyToOne(targetEntity: ActionList::class, inversedBy: 'permissions')]
    #[ORM\JoinColumn(name: 'action_list_identifier', referencedColumnName: 'identifier', nullable: false)]
    private ActionList $actionList;

    #[ORM\Column(enumType: PermissionEffect::class)]
    private PermissionEffect $effect = PermissionEffect::DENIED;

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public function getActionList(): ActionList
    {
        return $this->actionList;
    }

    public function setActionList(ActionList $actionList): void
    {
        $this->actionList = $actionList;
    }

    public function getEffect(): PermissionEffect
    {
        return $this->effect;
    }

    public function setEffect(PermissionEffect $effect): void
    {
        $this->effect = $effect;
    }
}
