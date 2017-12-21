<?php

namespace AppBundle\Entity;

/**
 * Positions
 */
class Positions
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $jobDescription;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Companies
     */
    private $company;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Positions
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set jobDescription
     *
     * @param string $jobDescription
     *
     * @return Positions
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }

    /**
     * Get jobDescription
     *
     * @return string
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Positions
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return Companies
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Companies $company
     *
     * @return $this
     */
    public function setCompany(Companies $company)
    {
        $this->company = $company;

        return $this;
    }
}
