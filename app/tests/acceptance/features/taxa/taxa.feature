Feature: Taxa

Scenario: Finding a specific taxon
    When I request "GET /taxa/1"
    Then I get a "200" response
    And scope into the "data" property
        And the properties exist:
            """
            id
            name
            type
            links
            """
        And the "links" property is an array
        And scope into the first "links" property
            And the properties exist:
                """
                rel
                uri
                """
    And reset scope

Scenario: Searching taxa by name
    When I request "GET /taxa?q=Animalia"
    Then I get a "200" response
    And the "pagination" property is an object
    And the "data" property is an array
    And scope into the first "data" property
        And the properties exist:
            """
            id
            name
            type
            links
            """
    And reset scope